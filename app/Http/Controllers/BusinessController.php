<?php

namespace App\Http\Controllers;

use App\User;
use App\Business;
use App\Category;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
            'business_name' => 'required',
            'business_phone' => 'required',
            'business_address' => 'required'
        ]);

        try {
            $user_data = $request->only(['name', 'email', 'password']);
            $user_data['password'] = Hash::make($user_data['password']);

            DB::beginTransaction();
            $user = User::create($user_data);

            $business_data = $request->only(['business_name', 'business_phone', 'business_address']);
            $business_data = [
                'name' => $business_data['business_name'],
                'phone' => $business_data['business_phone'],
                'address' => $business_data['business_address'],
                'user_id' => $user->id,
                'image' => 'default.png',
                'prefixes' => [
                    'table' => '',
                    'sku' => 'PR',
                    'transaction' => 'TRX',
                    'transaction_payment' => 'TRP',
                    'stock_adjustment' => 'SA',
                    'order' => 'OR'
                ]
            ];

            $business = Business::create($business_data);

            Role::create(['name' => 'Owner#'.$business->id]);
            Role::create(['name' => 'Cashier#'.$business->id]);

            Category::create(['name' => 'Makanan', 'business_id' => $business->id]);
            Category::create(['name' => 'Minuman', 'business_id' => $business->id]);

            $user->assignRole('Owner#'.$business->id);
            $user->business_id = $business->id;
            $user->save();

            DB::commit();

            Auth::login($user);

            return redirect()->route('home');
        } catch(\Exception $e) {
            DB::rollBack();

            flash($e->getMessage())->error();

            return redirect()->back();
        }
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
}
