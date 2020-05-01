<?php

namespace App\Http\Controllers;

use App\Table;

use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Table::where('business_id', auth()->user()->business_id)->get();
        return view('table.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('table.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $old = Table::where('business_id', auth()->user()->business_id);

        if($old->count() > 0) {
            $old->delete();
        }

        $type = $request->input('type');
        $count = $request->input('count');
        $data = [];

        if($type == 'abjad') {
            $alphas = range('A', 'Z');

            for($i = 0; $i < $count; $i++) {
                $temp['name'] = $alphas[$i];
                $temp['business_id'] = auth()->user()->business_id;
                $data[] = $temp;
            }
        } else {
            for($i = 0; $i < $count; $i++) {
                $temp['name'] = ($i+1);
                $temp['business_id'] = auth()->user()->business_id;
                $data[] = $temp;
            }
        }

        Table::insert($data);
        return redirect()->route('tables.index');
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
        //
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

    public function print()
    {
        $size = request()->size ?? 200;
        $data = Table::where('business_id', auth()->user()->business_id)->get();

        foreach($data as $key => $value) {
            $str = auth()->user()->business_id.'|'.$value->id;
            $data[$key]->qrId = openssl_encrypt($str, "des-ede3-cbc", "D2DFF1/G4fFu4o0@ff7#h57!", 0, "j4nf8FD4");
        }

        return view('table.print', compact('size', 'data'));
    }
}
