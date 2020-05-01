<?php

namespace App\Utils;

use App\Transaction;
use App\TransactionPayment;
use App\Product;

class Util
{
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
}