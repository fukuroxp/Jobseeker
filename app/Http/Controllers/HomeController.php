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
                        ->whereHas('transaction', function($q) {
                            $q->where('payment_status', 'paid');
                        })
                        ->get();

        $profit['bersih'] = 0;
        foreach($sells as $key => $sell) {
            $qty = $sell->qty;
            $product = $sell->product()->first();
            $sell_price = $sell->unit_price;
            $purchase_price = $product->purchase_price;
            $single_profit = $sell_price - $purchase_price;
            $profit['bersih'] += ($single_profit * $qty);
        }

        return view('home', compact('profit'));
    }

    public function loadMoreNotifications()
    {
        $notifications = auth()->user()->notifications()->orderBy('created_at', 'DESC')->paginate(10);

        auth()->user()->unreadNotifications->markAsRead();

        $notifications_data = [];
        foreach ($notifications as $notification) {
            $action = $notification->data['action'];
            $type = $notification->data['type'];
            $detail = json_decode($notification->data['detail'], TRUE);

            $title = '';
            $msg = '';
            $icon_class = '';
            $text_class = '';
            if ($type == 'promo') {
                $title = 'Ada Promo Baru nih!';
                $msg = $detail['message'];
                $icon_class = 'feather icon-plus-square';
                $text_class = 'primary';
            } else if($type == 'stock') {
                $title = 'Stok produk '.$detail['name'].' kosong';
                $msg = 'Silahkan tambahkan stok';
                $icon_class = ' feather icon-alert-triangle';
                $text_class = 'danger';
            } else if($type == 'order') {
                if($action == 'new') {
                    $title = 'Ada pesanan baru masuk';
                    $msg = 'Pesanan baru dari meja '.$detail['table'];
                    $icon_class = ' feather icon-plus-square';
                    $text_class = 'primary';
                } else if($action == 'sell') {
                    $title = 'Penjualan '.$detail['ref_no'].' berhasil dilakukan';
                    $msg = 'Penjualan pada meja '.$detail['table'].' sejumlah Rp '.$detail['total'].' berhasil dilakukan';
                    $icon_class = ' feather icon-check-circle';
                    $text_class = 'info';
                } else if($action == 'pay') {
                    $title = 'Pembayaran berhasil dilakukan';
                    $msg = 'Pembayaran pada penjualan '.$detail['ref_no'].' sejumlah Rp '.$detail['total'].' berhasil dibayarkan';
                    $icon_class = ' fa fa-dollar-sign';
                    $text_class = 'success';
                }
            }

            $notifications_data[] = [
                'msg' => $msg,
                'title' => $title,
                'icon_class' => $icon_class,
                'text_class' => $text_class,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at->diffForHumans()
            ];
        }

        return view('layouts.partials.notification_list', compact('notifications_data'));
    }
}
