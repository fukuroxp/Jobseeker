<?php

namespace App\Utils;

use App\Transaction;
use App\TransactionPayment;
use App\TransactionProduct;
use App\Product;

use \Notification;
use App\Notifications\CommonNotification;

class Util
{
    public function updateStockProduct($product_id, $qty, $opr = '+')
    {
        $product = Product::find($product_id);
        
        if($opr == '+')
            $product->qty = $product->qty + $qty;
        else
            $product->qty = $product->qty - $qty;

        $product->save();

        return true;
    }

    public function generateStockRefNo()
    {
        $count = Transaction::where('business_id', auth()->user()->business_id)
                            ->where(function($q) {
                                $q->where('type', 'opening_stock');
                                $q->orWhere('type', 'stock_adjustment');
                            })
                            ->count() + 1;

        $prefix = auth()->user()->business->prefixes['stock_adjustment'];

        return $prefix.date('Y').'/'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function generateTrxRefNo()
    {
        $count = Transaction::where('business_id', auth()->user()->business_id)
                            ->where('type', 'sells')
                            ->count() + 1;
        $prefix = auth()->user()->business->prefixes['transaction'];

        return $prefix.date('Y').'/'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function generatePaymentRefNo()
    {
        $count = TransactionPayment::where('business_id', auth()->user()->business_id)
                            ->count() + 1;
        $prefix = auth()->user()->business->prefixes['transaction_payment'];

        return $prefix.date('Y').'/'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function getProductData($product_id, $qty)
    {
        $product = Product::find($product_id);

        if($product->qty < $qty) {
            return $this->respondFailed('Stok produk '.$product->name.' habis');
        }

        return $product;
    }

    public function adjustPaymentStock($product_id, $product_name, $qty, $purchase_price, $type = 'opening_stock')
    {
        $business_id = auth()->user()->business_id;
        $employee_id = auth()->user()->id;
        $amount = ($purchase_price * $qty);

        $transaction = Transaction::create([
            'business_id' => $business_id,
            'employee_id' => $employee_id,
            'ref_no' => $this->generateStockRefNo(),
            'type' => $type,
            'status' => 'finish',
            'payment_status' => 'paid'
        ]);

        // TransactionProduct::create([
        //     'business_id' => $business_id,
        //     'transaction_id' => $transaction->id,
        //     'product_id' => $product_id,
        //     'product' => $product_name,
        //     'qty' => $qty,
        //     'unit_price' => $purchase_price,
        //     'type' => 'purchase'
        // ]);

        TransactionPayment::create([
            'business_id' => $business_id,
            'transaction_id' => $transaction->id,
            'customer_id' => null,
            'employee_id' => $employee_id,
            'ref_no' => $this->generatePaymentRefNo(),
            'type' => 'credit',
            'amount' => $amount,
            'method' => 'cash'
        ]);

        TransactionPayment::create([
            'business_id' => $business_id,
            'transaction_id' => $transaction->id,
            'customer_id' => null,
            'employee_id' => $employee_id,
            'ref_no' => $this->generatePaymentRefNo(),
            'type' => 'debit',
            'amount' => $amount,
            'method' => 'cash'
        ]);

        return $transaction;
    }

    public function notify($target, $action = '', $type = '', $detail = [])
    {
        Notification::send($target, new CommonNotification($action, $type, $detail));

        return true;
    }
}