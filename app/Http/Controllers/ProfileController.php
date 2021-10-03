<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function create()
    {
        $data = Profile::where('user_id', auth()->user()->id)->first();
        return view('setting.profilecreate', compact('data'));
    }

    public function store(Request $request)
    {   
        ini_set('upload_max_filesize', '10M');
        ini_set('post_max_size', '10M');

        $input = $request->except('_token');

        if ($request->hasFile('ijazahsd')) {
            $input['ijazahsd'] = Str::slug(auth()->user()->name). '_ijazah-sd_' . sha1(time()) . '.' . request()->ijazahsd->getClientOriginalExtension();

            request()->ijazahsd->move(public_path('uploads/file/'), $input['ijazahsd']);
        }

        if ($request->hasFile('ijazahsmp')) {
            $input['ijazahsmp'] = Str::slug(auth()->user()->name). '_ijazah-smp_' . sha1(time()) . '.' . request()->ijazahsmp->getClientOriginalExtension();

            request()->ijazahsmp->move(public_path('uploads/file/'), $input['ijazahsmp']);
        }

        if ($request->hasFile('ijazahsma')) {
            $input['ijazahsma'] = Str::slug(auth()->user()->name). '_ijazah-sma_' . sha1(time()) . '.' . request()->ijazahsma->getClientOriginalExtension();

            request()->ijazahsma->move(public_path('uploads/file/'), $input['ijazahsma']);
        }

        if ($request->hasFile('ijazahs1')) {
            $input['ijazahs1'] = Str::slug(auth()->user()->name). '_ijazah-s1_' . sha1(time()) . '.' . request()->ijazahs1->getClientOriginalExtension();

            request()->ijazahs1->move(public_path('uploads/file/'), $input['ijazahs1']);
        }

        if ($request->hasFile('ijazahs2')) {
            $input['ijazahs2'] = Str::slug(auth()->user()->name). '_ijazah-s2_' . sha1(time()) . '.' . request()->ijazahs2->getClientOriginalExtension();

            request()->ijazahs2->move(public_path('uploads/file/'), $input['ijazahs2']);
        }

        if ($request->hasFile('ijazahs3')) {
            $input['ijazahs3'] = Str::slug(auth()->user()->name). '_ijazah-s3_' . sha1(time()) . '.' . request()->ijazahs3->getClientOriginalExtension();

            request()->ijazahs3->move(public_path('uploads/file/'), $input['ijazahs3']);
        }
        
        if ($request->hasFile('bukti')) {
            $input['bukti'] = Str::slug(auth()->user()->name). '_bukti-sertifikat_' . sha1(time()) . '.' . request()->bukti->getClientOriginalExtension();

            request()->bukti->move(public_path('uploads/file/'), $input['bukti']);
        }
        
        if ($request->hasFile('portofolio')) {
            $input['portofolio'] = Str::slug(auth()->user()->name). '_portofolio_' . sha1(time()) . '.' . request()->portofolio->getClientOriginalExtension();

            request()->portofolio->move(public_path('uploads/file/'), $input['portofolio']);
        }

        $input['user_id'] = auth()->user()->id;

        $profile = Profile::where('user_id', auth()->id())->first();

        if ($profile) {
            $profile->update($input);
            flash('Berhasil mengedit data profile')->success();
        } else {
            flash('Berhasil menambah data profile')->success();
            Profile::create($input);
        }

        return redirect()->route('setting.index');
    }
}
