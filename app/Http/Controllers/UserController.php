<?php

namespace App\Http\Controllers;

use App\User;
use App\Kelas;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->type == 'student') {
            $role = 'student';
            $data = User::role('student')->get();
        } else {
            $role = 'mentor';
            $data = User::role('mentor')->get();
        }

        return view('users.index', compact('data', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all()->pluck('name', 'id');
        $role = request()->role;
        $data = null;
        return view('users.create', compact('role', 'kelas', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token', 'role']);
        $input['password'] = \Hash::make($input['password']);

        $role = $request->role;

        $user = User::create($input);
        $user->assignRole($role);

        flash('Berhasil menambahkan user')->success();

        return redirect()->route('users.index', ['type' => $role]);

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
        $data = User::find($id);
        $role = $data->getRoleNames()[0];
        $kelas = Kelas::all()->pluck('name', 'id');
        return view('users.edit', compact('data', 'kelas', 'role'));
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
        $input = $request->except(['_token', 'role', 'password']);

        $user = User::find($id);

        $role = $user->getRoleNames()[0];

        if($request->input('password'))
            $user->password = \Hash::make($request->password);

        $user->save();

        $user->update($input);

        flash('Berhasil mengubah user')->success();

        return redirect()->route('users.index', ['type' => $role]);
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
            User::find($id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus user'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus user'
            ]);
        }
    }
}
