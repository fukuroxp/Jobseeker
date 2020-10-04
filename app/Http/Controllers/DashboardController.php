<?php

namespace App\Http\Controllers;

use App\Subscription;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bg = 'bg-primary';
        $title = 'Selamat, '.auth()->user()->name;
        $message = 'Akun anda sedang dalam keadaan sangat bagus';
        $icon = 'feather icon-award';

        if(auth()->user()->hasRole('HRD') && !auth()->user()->business) {
            $bg = 'bg-danger';
            $title = 'Harap isi data terlebih dahulu';
            $message = 'Detail perusahaan anda belum lengkap, segera lengkapi di pengaturan!';
            $icon = 'feather icon-alert-circle';
        }

        if(auth()->user()->hasRole('Jobseeker') && !auth()->user()->profile) {
            $bg = 'bg-danger';
            $title = 'Harap isi data terlebih dahulu';
            $message = 'Harap isi data Profile mu di pengaturan terlebih dahulu!';
            $icon = 'feather icon-alert-circle';
        }
        return view('dashboard.index', compact('bg', 'title', 'message', 'icon'));
    }

    public function setting()
    {
        $data = auth()->user();
        return view('setting.index', compact('data'));
    }

    public function updateSetting(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nomor_induk = $request->nomor_induk;

        if ($request->hasFile('image')) {
            $user->image = time().'.'.request()->image->getClientOriginalExtension();
            
            request()->image->move(public_path('uploads/images/'), $user->image);
        }

        if($user->hasRole('student')) {
            $user->ttl = $request->ttl;
            $user->phone = $request->phone;
        } else {
            $user->jabatan = $request->jabatan;
            $user->address = $request->address;
        }

        $user->save();

        flash('Berhasil menyimpan pengaturan')->success();

        return redirect()->route('home.setting');
    }

    public function updatePassword(Request $request)
    {
        if($request->password != $request->con_password) {
            flash('Konfirmasi password tidak sama')->error();
            return redirect()->route('home.setting');
        }

        $credentials = [
            'email' => auth()->user()->email,
            'password' => $request->old_password
        ];

        if(!\Auth::attempt($credentials)) {
            flash('Password lama anda salah')->error();
            return redirect()->route('home.setting');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->password);
        $user->save();
        
        flash('Berhasil merubah password')->success();
        return redirect()->route('home.setting');
    }
}
