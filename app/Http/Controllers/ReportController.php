<?php

namespace App\Http\Controllers;

use App\TransactionProduct;
use App\TransactionPayment;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function profit()
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
                        ->whereHas('transaction', function($q) {
                            $q->where('payment_status', 'paid');
                        })
                        ->get();

        $profit['bersih'] = 0;
        $data = [];
        foreach($sells as $key => $sell) {
            $qty = $sell->qty;
            $product = $sell->product()->first();
            $sell_price = $sell->unit_price;
            $purchase_price = $product->purchase_price;
            $single_profit = $sell_price - $purchase_price;
            $profit['bersih'] += ($single_profit * $qty);
            $data[] = [
                'product' => $sell->product,
                'purchase_price' => $product->purchase_price,
                'sell_price' => $sell->unit_price,
                'qty' => $qty,
                'profit' => ($single_profit * $qty),
                'created_at' => $sell->created_at
            ];
        }

        return view('report.profit', compact('profit', 'data'));
    }

    public function stock()
    {
        $data = TransactionPayment::where('business_id', auth()->user()->business_id)
                        ->where(function($q) {
                            $q->whereHas('transaction', function($qt) {
                                $qt->where('type', 'opening_stock');
                            });
                            $q->orWhereHas('transaction', function($qt) {
                                $qt->where('type', 'stock_adjustment');
                            });
                        })
                        ->get();

        return view('report.stock', compact('data'));
    }
}
