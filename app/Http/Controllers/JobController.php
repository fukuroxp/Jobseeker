<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobApplicant;
use App\Subscription;
use App\Setting;

use App\Mail\ApplicantMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('HRD') && !auth()->user()->business) {
                flash('Harap isi data perusahaan di pengaturan terlebih dahulu')->error();
                return redirect()->route('dashboard');
            }
    
            if(auth()->user()->hasRole('Jobseeker') && !auth()->user()->profile) {
                flash('Harap isi data CV di pengaturan terlebih dahulu')->error();
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
            $data = Job::where('business_id', auth()->user()->business->id)->get();
        } else {
            $data = Job::all();
        }
        return view('job.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('job.create');
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
        $input['business_id'] = auth()->user()->business->id;
        
        Job::create($input);

        flash('Berhasil menambahkan lowongan')->success();

        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Job::find($id);

        return view('job.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Job::find($id);
        return view('job.edit', compact('data'));
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
        
        Job::find($id)->update($input);

        flash('Berhasil mengedit lowongan')->success();

        return redirect()->route('jobs.index');
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
            Job::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus lowongan'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus lowongan'
            ]);
        }
    }
    
    public function getApply($id)
    {
        $data = Job::find($id);
        return view('job.apply', compact('data'));
    }
    
    public function apply($id)
    {
        $input = request()->all();

        $job = Job::find($id);

        if(auth()->user()->hasRole('HRD') && ($job->business_id == auth()->user()->business->id)) {
            flash('Tidak dapat melamar di lowongan perusahaan anda sendiri')->error();
            return redirect()->route('jobs.index');
        }

        if(date('Y-m-d') > date('Y-m-d', strtotime($job->due_at))) {
            flash('Mohon maaf, Lowongan sudah ditutup')->error();
            return redirect()->route('jobs.index');
        }

        $isApplied = JobApplicant::where([
                                    'job_id' => $job->id,
                                    'user_id' => auth()->user()->id
                                ])->where(function($q) {
                                    $q->where('status', 'waiting')
                                        ->orWhere('status', 'approved');
                                })->first();

        if($isApplied) {
            if($isApplied->status == 'approved') {
                flash('Anda sudah di approve oleh pihak perusahaan. Harap cek email anda untuk tindak lanjut')->success();
            } else {
                flash('Anda sudah melamar di pekerjaan ini, harap tunggu konfirmasi dari perusahaan di email anda')->error();
            }
            return redirect()->route('jobs.index');
        }

        $input['business_id'] = $job->business_id;
        $input['job_id'] = $job->id;
        $input['user_id'] = auth()->user()->id;
        
        $apply = JobApplicant::create($input);

        $setting = Setting::first();

        $data = (object)[
            'to' => $apply->business->email,
            'title' => 'Lamaran - ' . $apply->job->title,
            'note' => $apply->note,
            'from' => $setting->data['mail_from_address']
        ];

        Mail::send([], [], function($message) use ($data) {
            $message->from($data->from);
            $message->to($data->to);
            $message->subject($data->title);
            $message->setBody($data->note, 'text/html');
        });

        flash('Berhasil melamar pekerjaan')->success();

        return redirect()->route('jobs.index');
    }

    public function getApproval($id, $approval) {
        $data = JobApplicant::find($id);
        return view('job.approval', compact('data', 'approval'));
    }

    public function action($id, Request $request)
    {
        try {
            $job = JobApplicant::find($id);
            $job->update(['status' => $request->status]);

            $setting = Setting::first();

            $data = (object)[
                'to' => $job->user->email,
                'title' => $request->title,
                'note' => $request->note,
                'from' => $setting->data['mail_from_address']
            ];

            Mail::send([], [], function($message) use ($data) {
                $message->from($data->from);
                $message->to($data->to);
                $message->subject($data->title);
                $message->setBody($data->note, 'text/html');
            });

            flash('Berhasil '.$request->status.' lamaran')->success();
            return redirect()->route('applicants.index');
        } catch(\Exception $e) {
            flash('Berhasil '.$request->status.' lamaran')->success();
            return redirect()->route('applicants.index');
        }
    }
}
