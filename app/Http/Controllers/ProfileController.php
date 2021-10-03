<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Validator;
use Storage;

class ProfileController extends Controller
{
    public function create()
    {
        $data = Profile::where('user_id', auth()->user()->id)->first();
        return view('setting.profilecreate', compact('data'));
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'ijazahsd' => 'mimes:jpeg,png,pdf',
            'ijazahsmp' => 'mimes:jpeg,png,pdf',
            'ijazahsma' => 'mimes:jpeg,png,pdf',
            'ijazahs1' => 'mimes:jpeg,png,pdf',
            'ijazahs2' => 'mimes:jpeg,png,pdf',
            'ijazahs3' => 'mimes:jpeg,png,pdf',
        ]);

        $input = $request->except('_token');

        if ($request->hasFile('ijazahsd')) {
            $input['ijazahsd'] = time() . '.' . request()->ijazahsd->getClientOriginalExtension();
            request()->ijazahsd->store('public/uploads');
            //request()->ijazahsd->move(public_path('uploads/file/'), $input['ijazahsd']);
        }

        if ($request->hasFile('ijazahsmp')) {
            $input['ijazahsmp'] = time() . '.' . request()->ijazahsmp->getClientOriginalExtension();
            request()->ijazahsmp->store('public/uploads');
            //request()->ijazahsmp->move(public_path('uploads/file/'), $input['ijazahsmp']);
        }

        if ($request->hasFile('ijazahsma')) {
            $input['ijazahsma'] = time() . '.' . request()->ijazahsma->getClientOriginalExtension();
            request()->ijazahsma->store('public/uploads');
            //request()->ijazahsma->move(public_path('uploads/file/'), $input['ijazahsma']);
        }

        if ($request->hasFile('ijazahs1')) {
            $input['ijazahs1'] = time() . '.' . request()->ijazahs1->getClientOriginalExtension();
            request()->ijazahs1->store('public/uploads');
            //request()->ijazahs1->move(public_path('uploads/file/'), $input['ijazahs1']);
        }

        if ($request->hasFile('ijazahs2')) {
            $input['ijazahs2'] = time() . '.' . request()->ijazahs2->getClientOriginalExtension();
            request()->ijazahs2->store('public/uploads');
            //request()->ijazahs2->move(public_path('uploads/file/'), $input['ijazahs2']);
        }

        if ($request->hasFile('ijazahs3')) {
            $input['ijazahs3'] = time() . '.' . request()->ijazahs3->getClientOriginalExtension();
            request()->ijazahs3->store('public/uploads');
            //request()->ijazahs3->move(public_path('uploads/file/'), $input['ijazahs3']);
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
