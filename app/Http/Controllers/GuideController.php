<?php

namespace App\Http\Controllers;

use App\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasAnyRole('Super Admin|Admin'))
        $data = Guide::all();
        else if (auth()->user()->hasRole('HRD'))
        $data = Guide::where('for', 'HRD')->get();
        else
        $data = Guide::where('for', 'Jobseeker')->get();
        
        return view('guide.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $for = [
            'HRD' => 'Employer/Perusahaan',
            'Jobseeker' => 'Jobseeker/Pelamar',
        ];

        return view('guide.create', compact('for'));
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
            $input['file'] = time().'.'.request()->file->getClientOriginalExtension();
            
            request()->file->move(public_path('uploads/file/'), $input['file']);
        }
        
        Guide::create($input);

        flash('Berhasil menambahkan panduan')->success();

        return redirect()->route('guides.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $for = [
            'HRD' => 'HRD',
            'Jobseeker' => 'Jobseeker',
        ];

        $data = Guide::find($id);
        return view('guide.edit', compact('data', 'for'));
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
            $input['file'] = time().'.'.request()->file->getClientOriginalExtension();
            
            request()->file->move(public_path('uploads/file/'), $input['file']);
        }
        
        Guide::find($id)->update($input);

        flash('Berhasil mengedit paket layanan')->success();

        return redirect()->route('guides.index');
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
            Guide::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus paket layanan'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus paket layanan'
            ]);
        }
    }
}
