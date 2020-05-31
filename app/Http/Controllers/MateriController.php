<?php

namespace App\Http\Controllers;

use App\Materi;

use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Materi::all();
        return view('materi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materi.create');
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

        if ($request->hasFile('file')) {
            $input['file'] = time().'_'.request()->file->getClientOriginalName();
            
            request()->file->move(public_path('uploads/file/'), $input['file']);
        }
        
        Materi::create($input);

        flash('Berhasil menambahkan materi')->success();

        return redirect()->route('materi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Materi::find($id);

        activity()
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->log(':causer.name mendownload materi :subject.name');

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Materi::find($id);
        return view('materi.edit', compact('data'));
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

        if ($request->hasFile('file')) {
            $input['file'] = time().'_'.request()->file->getClientOriginalName();
            
            request()->file->move(public_path('uploads/file/'), $input['file']);
        }
        
        Materi::find($id)->update($input);

        flash('Berhasil mengedit materi')->success();

        return redirect()->route('materi.index');
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
            Materi::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus materi'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus materi'
            ]);
        }
    }
}
