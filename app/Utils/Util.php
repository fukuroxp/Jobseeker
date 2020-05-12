<?php

namespace App\Utils;

use App\Transaction;
use App\TransactionPayment;
use App\TransactionProduct;
use App\Product;
use App\Business;
use App\User;
use App\Order;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

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

        if($product->qty == 0) {
            $users = User::where('business_id', auth()->user()->business_id)->get();
            $prefix = Business::find(auth()->user()->business_id)->prefixes['table'];
            $this->notify($users, 'empty', 'stock', [
                'name' => $product->name
            ]);
        }

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

        $prefix = Business::find(auth()->user()->business_id)->prefixes['stock_adjustment'];

        return $prefix.date('Y').'/'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function generateOrderRefNo($business_id)
    {
        $count = Order::where('business_id', $business_id)
                            ->count() + 1;
        $prefix = Business::find($business_id)->prefixes['order'];

        return $prefix.date('Y').'/'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function generateTrxRefNo()
    {
        $count = Transaction::where('business_id', auth()->user()->business_id)
                            ->where('type', 'sells')
                            ->count() + 1;
        $prefix = Business::find(auth()->user()->business_id)->prefixes['transaction'];

        return $prefix.date('Y').'/'.str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function generatePaymentRefNo()
    {
        $count = TransactionPayment::where('business_id', auth()->user()->business_id)
                            ->count() + 1;
        $prefix = Business::find(auth()->user()->business_id)->prefixes['transaction_payment'];

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

    public function adjustPaymentStock($product_id, $product_name, $qty, $purchase_price, $type = 'opening_stock', $increament = true)
    {
        $business_id = auth()->user()->business_id;
        $employee_id = auth()->user()->id;
        $amount = ($qty > 0) ? ($purchase_price * $qty) : $purchase_price;

        $transaction = Transaction::create([
            'business_id' => $business_id,
            'employee_id' => $employee_id,
            'ref_no' => $this->generateStockRefNo(),
            'type' => $type,
            'total' => $amount,
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

        if($type == 'opening_stock' || $increament) {
            TransactionPayment::create([
                'business_id' => $business_id,
                'transaction_id' => $transaction->id,
                'customer_id' => null,
                'employee_id' => $employee_id,
                'product_id' => $product_id,
                'ref_no' => $this->generatePaymentRefNo(),
                'type' => 'credit',
                'amount' => $amount,
                'method' => 'cash',
                'description' => 'Modal Usaha'
            ]);
    
            TransactionPayment::create([
                'business_id' => $business_id,
                'transaction_id' => $transaction->id,
                'customer_id' => null,
                'employee_id' => $employee_id,
                'product_id' => $product_id,
                'ref_no' => $this->generatePaymentRefNo(),
                'type' => 'debit',
                'amount' => $amount,
                'method' => 'cash',
                'description' => 'Pembelian Barang'
            ]);
        } else {
            TransactionPayment::create([
                'business_id' => $business_id,
                'transaction_id' => $transaction->id,
                'customer_id' => null,
                'employee_id' => $employee_id,
                'product_id' => $product_id,
                'ref_no' => $this->generatePaymentRefNo(),
                'type' => 'credit',
                'amount' => $amount,
                'method' => 'cash',
                'description' => 'Retur Barang'
            ]);
            
            TransactionPayment::create([
                'business_id' => $business_id,
                'transaction_id' => $transaction->id,
                'customer_id' => null,
                'employee_id' => $employee_id,
                'product_id' => $product_id,
                'ref_no' => $this->generatePaymentRefNo(),
                'type' => 'debit',
                'amount' => $amount,
                'method' => 'cash',
                'description' => 'Refund Modal Usaha'
            ]);
        }

        return $transaction;
    }

    public function notify($target, $action = '', $type = '', $detail = [])
    {
        $tokens = $target->pluck('fcm')->toArray();
        if($tokens) {
            $title = '';
            $msg = '';
            if ($type == 'promo') {
                $title = 'Ada Promo Baru nih!';
                $msg = $detail['message'];
            } else if($type == 'stock') {
                $title = 'Stok produk '.$detail['name'].' kosong';
                $msg = 'Silahkan tambahkan stok';
            } else if($type == 'order') {
                if($action == 'new') {
                    $title = 'Ada pesanan baru masuk';
                    $msg = 'Pesanan baru dari meja '.$detail['table'];
                } else if($action == 'sell') {
                    $title = 'Penjualan '.$detail['ref_no'].' berhasil dilakukan';
                    $msg = 'Penjualan pada meja '.$detail['table'].' sejumlah Rp '.$detail['total'].' berhasil dilakukan';
                } else if($action == 'pay') {
                    $title = 'Pembayaran berhasil dilakukan';
                    $msg = 'Pembayaran pada penjualan '.$detail['ref_no'].' sejumlah Rp '.$detail['total'].' berhasil dibayarkan';
                }
            }
            $this->sendFcmNotification($tokens, [
                'title' => $title,
                'contents' => $msg
            ]);
        }

        Notification::send($target, new CommonNotification($action, $type, $detail));

        return true;
    }

    public function sendFcmNotification($tokens, $notif, $data = [])
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        
        $notificationBuilder = new PayloadNotificationBuilder($notif['title']);
        $notificationBuilder->setBody($notif['contents'])
                            ->setColor('#e9622a')
                            ->setSound('default');
        
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        
        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        
        return $downstreamResponse;
    }
}