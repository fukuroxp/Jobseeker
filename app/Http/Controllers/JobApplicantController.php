<?php

namespace App\Http\Controllers;

use App\JobApplicant;
use App\Profile;
use App\Subscription;

use Illuminate\Http\Request;

class JobApplicantController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('HRD') && !auth()->user()->business) {
                flash('Harap isi data perusahaan di pengaturan terlebih dahulu')->error();
                return redirect()->route('dashboard');
            }
    
            if(auth()->user()->hasRole('Jobseeker') && !auth()->user()->profile) {
                flash('Harap isi data CV anda di pengaturan terlebih dahulu')->error();
                return redirect()->route('dashboard');
            }

            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('HRD')) {
            $data = JobApplicant::where('business_id', auth()->user()->business->id)->get();
        } else if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin')) {
            $data = JobApplicant::all();
        } else {
            $data = JobApplicant::where('user_id', auth()->user()->id)->get();
        }

        return view('job.applicant', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function detail($id)
    {   
        $data = JobApplicant::where('id', $id)->first();
        
        if(auth()->user()->hasRole('HRD') ) {
            if($data->business_id != auth()->user()->business->id)
            {
                flash('Anda Tidak Memiliki Otoritas Untuk Melihat Lamaran ini!')->warning();
                return back();
            }
            else{
                return view('job.detailapplicant', compact('data'));
            }
        }
        else if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin')) {
            return view('job.detailapplicant', compact('data'));
        }
        
        
    }
}
