<?php

namespace App\Http\Controllers;

use App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SponsorController extends Controller
{
    public function index()
    {
        $data = Sponsor::all();

        return view('sponsor.index', compact('data'));
    }

    public function create()
    {
        return view('sponsor.create');
    }

    public function store(Request $request)
    {  
        $input = $request->except('_token');

        if ($request->hasFile('image')) {
            $input['image'] = time() . '.' . request()->image->getClientOriginalExtension();

            request()->image->move(public_path('uploads/images/'), $input['image']);
        }

        Sponsor::create($input);

        flash('Berhasil menambah sponsor')->success();
        return redirect()->route('sponsor.index');
    }

    public function destroy($id)
    {
        try {
            $sponsor = Sponsor::find($id);
            $image = $sponsor->image;
            // dd($slider);
            File::delete('uploads/images/'.$image);

            $sponsor->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus sponsor'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus sponsor'
            ]);
        }
    }
}
