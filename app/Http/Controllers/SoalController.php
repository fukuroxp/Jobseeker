<?php

namespace App\Http\Controllers;

use App\Soal;
use App\SoalItem;
use App\Exam;
use App\ExamAnswer;

use DB;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Soal::all();

        if(auth()->user()->hasRole('student')) {
            $type = request()->type ?? 'UTS';
            
            $data = Soal::where('name', $type)->first();

            if($data) {
                $data->exam_state = 'none';
                $data->timer_ori = $data->timer;
                $data->is_permitted = $this->calculateNilai();
                
                $exist_exam = Exam::where([
                    'soal_id' => $data->id,
                    'user_id' => auth()->user()->id
                ])->first();
    
                if($exist_exam) {
                    $diff = strtotime($exist_exam->expired_at) - strtotime(date('Y-m-d H:i:s'));
                    $data->timer = $diff;
                    $data->exam_state = 'start';
    
                    if($diff <= 0) {
                        $exist_exam->state = 'done';
                        $exist_exam->save();
                        $data->timer = $diff;
                        $data->exam_state = 'done';
                    }
                }
            } else {
                $exist_exam = null;
            }

            return view('soal.student', compact('data', 'exist_exam'));
        }

        return view('soal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['timer'] = $input['timer']*60;
        
        $soal = Soal::create($input);

        flash('Berhasil menambahkan soal')->success();

        return redirect()->route('soal.show', [$soal->id]);
    }

    public function storeItem($id, Request $request)
    {
        $item_data = $request->all();
        $items = [];

        if(array_key_exists('old', $item_data)) {
            foreach($item_data['old'] as $id_item => $item) {
                $olds = [
                    'soal_id' => $id,
                    'nomor' => $item['nomor'],
                    'question' => $item['soal'],
                    'choices' => json_encode($item['choices']),
                    'kj' => $item['kj']
                ];

                SoalItem::find($id_item)->update($olds);
            }
        }

        if(array_key_exists('item', $item_data)) {
            foreach($item_data['item'] as $key => $item) {
                $items[] = [
                    'soal_id' => $id,
                    'nomor' => $item['nomor'],
                    'question' => $item['soal'],
                    'choices' => json_encode($item['choices']),
                    'kj' => $item['kj']
                ];
            }
        }

        if(count($items) > 0) {
            SoalItem::insert($items);
        }

        flash('Berhasil menyimpan butir soal')->success();

        return redirect()->route('soal.show', [$id]);
    }

    public function storeAnswer(Request $request)
    {
        try {
            $input = $request->all();
            $input['user_id'] = auth()->user()->id;
            $input['soal_item_id'] = $input['id'];

            $soal_item = SoalItem::findOrFail($input['id']);

            $input['exam_id'] = Exam::where([
                'user_id' => auth()->user()->id,
                'soal_id' => $soal_item->soal_id
            ])->first()->id;
            
            if(array_key_exists('answer', $input)) {
                if($input['answer'] == $soal_item->kj)
                    $input['is_true'] = true;
                else 
                    $input['is_true'] = false;
            } else {
                $input['is_true'] = false;
            }

            $old_answer = ExamAnswer::where([
                'user_id' => auth()->user()->id,
                'soal_item_id' => $input['id'],
                'soal_id' => $input['soal_id']
            ])->first();

            if($old_answer) {
                $old_answer->update($input);
            } else {
                ExamAnswer::create($input);
            }

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menyimpan jawaban'
            ]);
        } catch(\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan jawaban'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Soal::find($id);
        return view('soal.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Soal::find($id);
        return view('soal.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $input['timer'] = $input['timer']*60;
        
        Soal::find($id)->update($input);

        flash('Berhasil mengedit soal')->success();

        return redirect()->route('soal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Soal::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus soal'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus soal'
            ]);
        }
    }

    public function examStart($id)
    {
        try {
            $soal = Soal::findOrFail($id);

            $expired_at = strtotime(date('Y-m-d H:i:s')) + $soal->timer;
            $expired_at = date('Y-m-d H:i:s', $expired_at);

            $exam = Exam::create([
                'user_id' => auth()->user()->id,
                'soal_id' => $id,
                'expired_at' => $expired_at
            ]);

            activity()
                ->performedOn($soal)
                ->causedBy(auth()->user())
                ->log(':causer.name memulai timer ujian :subject.name');

            return response()->json([
                'status' => true,
                'message' => 'Berhasil memulai ujian',
                'exam_id' => $exam->id
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memulai ujian'
            ]);
        }
    }

    public function examFinish(Request $request)
    {
        try {
            DB::beginTransaction();

            $exam = Exam::findOrFail($request->id);
            $exam->update(['state' => 'done']);
            $soal = Soal::findOrFail($exam->soal_id);

            $count_soal = $soal->size_item;
            $count_true = ExamAnswer::where([
                'user_id' => auth()->user()->id,
                'exam_id' => $request->id,
                'soal_id' => $soal->id,
                'is_true' => true
            ])->count();
            $nilai = ($count_true/$count_soal) * 100;

            $user = auth()->user();
            $old_nilai = json_decode($user->nilai, TRUE);
            $old_nilai[strtolower($soal->name)] = $nilai;
            $user->nilai = json_encode($old_nilai);
            $user->save();

            activity()
                ->performedOn($soal)
                ->causedBy(auth()->user())
                ->log(':causer.name menyelesaikan timer ujian :subject.name');

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menyelesaikan ujian'
            ]);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyelesaikan ujian'
            ]);
        }
    }

    private function calculateNilai()
    {
        $user = auth()->user();
        $nilai = json_decode($user->nilai, TRUE);

        $meanTugas = ($nilai['tugas_1'] + $nilai['tugas_2'] + $nilai['tugas_3'] + $nilai['tugas_4']) / 4;
        $nilaiUts = $nilai['uts'];

        if($meanTugas >= 75 && $nilaiUts >= 80) {
            return true;
        } else {
            return false;
        }
    }
}
