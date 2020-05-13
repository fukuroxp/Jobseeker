<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Transaction;
use App\TransactionProduct;

use App\Utils\Util;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $commonUtil;

    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    public function report()
    {
        $profit['kotor'] = \DB::select(
            '(SELECT 
                SUM(
                    IF(TP.type="credit", TP.amount, -1 * TP.amount)
                ) as balance FROM transaction_payments AS TP
                WHERE TP.business_id = '.auth()->user()->business_id.' AND
                DATE(TP.created_at) = DATE(NOW())
            )')[0]->balance ?? 0;

        $tp = TransactionProduct::where('business_id', auth()->user()->business_id)
                        ->where('type', 'sell')
                        ->whereDate('created_at', '=', date('Y-m-d'))
                        ->whereHas('transaction', function($q) {
                            $q->where('payment_status', 'paid');
                        })
                        ->get();

        $profit['bersih'] = 0;
        $data = [];
        foreach($tp as $key => $sell) {
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

        $sells = Transaction::where('type', 'sells')
                        ->with([
                            'business' => function($q) {
                                $q->select(['id', 'name', 'address']);
                            },
                            'employee' => function($q) {
                                $q->select(['id', 'name']);
                            },
                            'table' => function($q) {
                                $q->select(['id', 'name']);
                            },
                        ])
                        ->where('business_id', auth()->user()->business_id)
                        ->whereDate('created_at', '=', date('Y-m-d'))
                        ->orderBy('created_at', 'DESC')
                        ->get();

        $response = [
            'profit' => $profit,
            'sells' => $sells
        ];

        return $this->respondSuccess('Berhasil', $response);
    }

    public function notify()
    {
        $message = request()->input('message');

        if(!$message) return $this->respondFailed('Harap isi pesan');
        
        $lat = auth()->user()->lat;
        $lng = auth()->user()->lng;
        $radius = 25;

        $users = User::role('Customer');

        if($lat && $lng) {
            $users = $users->whereRaw( 
                \DB::raw( "(3959 * acos( cos( radians($lat) ) * cos( radians( lat ) )  * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) < $radius ")
            )
            ->get();
        } else {
            $users = $users->get();
        }

        $this->commonUtil->notify($users, 'add', 'promo', ['message' => $message]);

        return $this->respondSuccess('Berhasil mengirim notifikasi');
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
                $icon_class = 'feather icon-alert-triangle';
                $text_class = 'danger';
            } else if($type == 'order') {
                if($action == 'new') {
                    $title = 'Ada pesanan baru masuk';
                    $msg = 'Pesanan baru dari meja '.$detail['table'];
                    $icon_class = 'feather icon-plus-square';
                    $text_class = 'primary';
                } else if($action == 'sell') {
                    $title = 'Penjualan '.$detail['ref_no'].' berhasil dilakukan';
                    $msg = 'Penjualan pada meja '.$detail['table'].' sejumlah Rp '.$detail['total'].' berhasil dilakukan';
                    $icon_class = 'feather icon-check-circle';
                    $text_class = 'info';
                } else if($action == 'pay') {
                    $title = 'Pembayaran berhasil dilakukan';
                    $msg = 'Pembayaran pada penjualan '.$detail['ref_no'].' sejumlah Rp '.$detail['total'].' berhasil dibayarkan';
                    $icon_class = 'fa fa-dollar-sign';
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

        return response()->json($notifications_data);
    }
}
