<?php

namespace App\Http\Controllers;

use App\Package;
use App\Subscription;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {   
            if(auth()->user()->hasRole('HRD') && !auth()->user()->business) {
                flash('Harap isi data perusahaan di pengaturan terlebih dahulu')->error();
                return redirect()->route('dashboard');
            }

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) {
            $data = Subscription::all();
        } else {
            $data = Subscription::where([
                'user_id' => auth()->id()
            ])->get();
        }

        return view('subscription.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Package::all()->pluck('name', 'id');
        return view('subscription.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->id();
        $input['status'] = 'waiting';

        if ($request->hasFile('image')) {
            $input['image'] = time().'.'.request()->image->getClientOriginalExtension();
            
            request()->image->move(public_path('uploads/images/'), $input['image']);
        }
        
        Subscription::create($input);

        flash('Berhasil menambahkan paket layanan')->success();

        return redirect()->route('subscriptions.index');
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
        // $data = Package::find($id);
        // return view('package.edit', compact('data'));
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
        // $input = $request->all();
        
        // Package::find($id)->update($input);

        // flash('Berhasil mengedit paket layanan')->success();

        // return redirect()->route('packages.index');
    }

    public function action(Request $request, $id)
    {
        try {
            $subscription = Subscription::find($id);

            $package = Package::find($subscription->package_id);
            $last_date = Subscription::getDateLastActiveSubscription($subscription->user_id);
            $expired_at = strtotime('+'.$package->duration.' day', strtotime($last_date));

            $subscription->update([
                'status' => $request->status ?? 'waiting',
                'expired_at' => $request->status == 'approved' ? date('Y-m-d', $expired_at) : null
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil ' . $request->status . ' paket layanan'
            ]);
        } catch(\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'message' => 'Gagal ' . $request->status .  ' paket layanan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try {
        //     Package::find($id)->delete();

        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Berhasil menghapus paket layanan'
        //     ]);
        // } catch(\Exception $e) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Gagal menghapus paket layanan'
        //     ]);
        // }
    }
}
