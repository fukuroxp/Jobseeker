<?php

namespace App\Http\Controllers;

use App\Business;
use App\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index() {
        $user = auth()->user();
        $business = $user->business;
        $setting = null;
        if($user->hasRole('Super Admin')) {
            $setting = Setting::first();
        }
        return view('setting.index', compact('user', 'business', 'setting'));
    }

    public function updateUser(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $user->image = time().'.'.request()->image->getClientOriginalExtension();
            
            request()->image->move(public_path('uploads/images/'), $user->image);
        }

        $user->save();

        flash('Berhasil menyimpan pengaturan')->success();

        return redirect()->route('setting.index');
    }

    public function updatePassword(Request $request)
    {
        if($request->password != $request->con_password) {
            flash('Konfirmasi password tidak sama')->error();
            return redirect()->route('setting.index');
        }

        $credentials = [
            'email' => auth()->user()->email,
            'password' => $request->old_password
        ];

        if(!\Auth::attempt($credentials)) {
            flash('Password lama anda salah')->error();
            return redirect()->route('setting.index');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->password);
        $user->save();
        
        flash('Berhasil merubah password')->success();
        return redirect()->route('setting.index');
    }

    public function updateBusiness(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['name'], '-');

        if ($request->hasFile('logo')) {
            $data['logo'] = time().'.'.request()->logo->getClientOriginalExtension();
            
            request()->logo->move(public_path('uploads/images/'), $data['logo']);
        }

        $business = auth()->user()->business;

        if(!$business) {
            $business = Business::create($data);
        } else {
            $business->update($data);
        }
        
        flash('Berhasil merubah perusahaan')->success();
        return redirect()->route('setting.index');
    }

    public function updateMailer(Request $request) {
        $setting = Setting::first();
        $setting->update(['data' => $request->all()]);
        
        flash('Berhasil merubah pengaturan super admin')->success();
        return redirect()->route('setting.index');
    }
}
