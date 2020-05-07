<?php

namespace App\Http\Controllers\Api;

use App\User;

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

    public function notify()
    {
        $message = request()->input('message');

        if(!$message) return $this->respondFailed('Harap isi pesan');

        $users = User::role('Customer')->get();
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
