<?php

namespace App\Http\Controllers;

use App\User;
use App\Business;

use Auth;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $business = auth()->user()->business;
        return view('setting.index', compact('user', 'business'));
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
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        flash('Berhasil menyimpan pengaturan')->success();

        return redirect()->route('settings.index');
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
        $business = Business::find($id);
        $business->name = $request->name;
        $business->phone = $request->phone;
        $business->address = $request->address;
        $business->prefixes = $request->prefixes;

        if ($request->hasFile('image')) {
            $business->image = time().'.'.request()->image->getClientOriginalExtension();
            
            request()->image->move(public_path('uploads/images/'), $business->image);
        }

        $business->save();

        flash('Berhasil menyimpan pengaturan')->success();

        return redirect()->route('settings.index');
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

    public function updatePassword(Request $request)
    {
        if($request->password != $request->con_password) {
            flash('Konfirmasi password tidak sama')->error();
            return redirect()->route('settings.index');
        }

        $credentials = [
            'email' => auth()->user()->email,
            'password' => $request->old_password
        ];

        if(!Auth::attempt($credentials)) {
            flash('Password lama anda salah')->error();
            return redirect()->route('settings.index');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->password);
        $user->save();
        
        flash('Berhasil merubah password')->success();
        return redirect()->route('settings.index');
    }
}
