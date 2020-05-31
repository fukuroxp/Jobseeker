<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskUser;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Task::orderBy('created_at', 'DESC')->get();
        return view('task.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
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
        
        Task::create($input);

        flash('Berhasil menambahkan tugas')->success();

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!auth()->user()->hasRole('student')) {
            $data = TaskUser::where('task_id', $id)->get();
            $task = Task::find($id);
            return view('task.detail', compact('data', 'task'));
        }

        $data = Task::find($id);
        return view('task.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Task::find($id);
        return view('task.edit', compact('data'));
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
        
        Task::find($id)->update($input);

        flash('Berhasil mengedit tugas')->success();

        return redirect()->route('task.index');
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
            Task::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus tugas'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus tugas'
            ]);
        }
    }

    public function submit($id, Request $request)
    {
        if ($request->hasFile('file')) {
            $file = time().'_'.request()->file->getClientOriginalName();
            
            request()->file->move(public_path('uploads/file/'), $file);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan tugas'
            ]);
        }

        $task = TaskUser::where([
            'user_id' => auth()->user()->id,
            'task_id' => $id
        ])->first();

        if($task) {
            $task = $task->update([
                'user_id' => auth()->user()->id,
                'task_id' => $id,
                'is_turned_in' => true,
                'file' => $file
            ]);
        } else {
            $task = TaskUser::create([
                'user_id' => auth()->user()->id,
                'task_id' => $id,
                'is_turned_in' => true,
                'file' => $file
            ]);
        }

        $data = Task::find($id);

        activity()
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->log(':causer.name mengerjakan tugas :subject.name');

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menyimpan tugas'
        ]);

    }
}
