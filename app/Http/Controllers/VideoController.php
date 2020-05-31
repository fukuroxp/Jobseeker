<?php

namespace App\Http\Controllers;

use App\Video;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Video::all();
        return view('video.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
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
        
        Video::create($input);

        flash('Berhasil menambahkan video')->success();

        return redirect()->route('video.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Video::find($id);

            activity()
                ->performedOn($data)
                ->causedBy(auth()->user())
                ->log(':causer.name telah menonton video :subject.name hingga selesai');

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menyelesaikan video'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyelesaikan video'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Video::find($id);
        return view('video.edit', compact('data'));
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
        
        Video::find($id)->update($input);

        flash('Berhasil mengedit video')->success();

        return redirect()->route('video.index');
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
            Video::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus video'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus video'
            ]);
        }
    }
}
