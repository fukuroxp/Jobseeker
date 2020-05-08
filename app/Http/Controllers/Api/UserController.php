<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return $this->respondSuccess('Berhasil', $user);
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $this->respondSuccess('Berhasil merubah profile', $user);
    }

    public function updatePassword(Request $request)
    {
        if($request->password != $request->con_password) {
            return $this->respondFailed('Konfirmasi password tidak sama');
        }

        $credentials = [
            'email' => auth()->user()->email,
            'password' => $request->old_password
        ];

        if(!\Auth::attempt($credentials)) {
            return $this->respondFailed('Password lama anda salah');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->password);
        $user->save();

        return $this->respondSuccess('Berhasil merubah password', $user);
    }
}
