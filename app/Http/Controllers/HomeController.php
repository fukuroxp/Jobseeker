<?php

namespace App\Http\Controllers;

use App\TransactionProduct;

use Illuminate\Http\Request;

class HomeController extends Controller
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
        $profit['kotor'] = \DB::select(
            '(SELECT 
                SUM(
                    IF(TP.type="credit", TP.amount, -1 * TP.amount)
                ) as balance FROM transaction_payments AS TP
                WHERE TP.business_id = '.auth()->user()->business_id.'
            )')[0]->balance;

        $sells = TransactionProduct::where('business_id', auth()->user()->business_id)
                        ->where('type', 'sell')
                        ->get();

        $profit['bersih'] = 0;
        foreach($sells as $key => $sell) {
            $qty = $sell->qty;
            $product = $sell->product()->first();
            $sell_price = $product->sell_price;
            $purchase_price = $product->purchase_price;
            $single_profit = $sell_price - $purchase_price;
            $profit['bersih'] += ($single_profit * $qty);
        }

        return view('home', compact('profit'));
    }
}
