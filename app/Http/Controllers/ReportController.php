<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ReportController extends Controller
{
    public function activity()
    {
        $data = Activity::all();
        return view('report.activity', compact('data'));
    }

    public function nilai()
    {
        $data = User::role('student')->get();
        
        if(auth()->user()->hasRole('student'))
            $data = [auth()->user()];

        return view('report.nilai', compact('data'));
    }

    public function saveNilai()
    {
        try {
            $input = request()->all();

            $user = User::find($input['id']);
            
            $nilai = json_decode($user->nilai, TRUE);
            $nilai[$input['index']] = $input['nilai'];

            $user->nilai = json_encode($nilai);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menyimpan nilai'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan nilai'
            ]);
        }
    }
}
