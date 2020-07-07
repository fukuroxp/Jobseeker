<?php

namespace App\Http\Controllers;

use App\Materi;
use App\Video;
use App\Feed;
use App\FeedReply;

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
        $feeds = Feed::orderBy('created_at', 'desc')->get();
        $materi = Materi::orderBy('created_at', 'desc')->take(5)->get();
        $video = Video::orderBy('created_at', 'desc')->take(5)->get();
        return view('home', compact('feeds', 'materi', 'video'));
    }

    public function setting()
    {
        $data = auth()->user();
        return view('setting.index', compact('data'));
    }

    public function updateSetting(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nomor_induk = $request->nomor_induk;

        if ($request->hasFile('image')) {
            $user->image = time().'.'.request()->image->getClientOriginalExtension();
            
            request()->image->move(public_path('uploads/images/'), $user->image);
        }

        if($user->hasRole('student')) {
            $user->ttl = $request->ttl;
            $user->phone = $request->phone;
        } else {
            $user->jabatan = $request->jabatan;
            $user->address = $request->address;
        }

        $user->save();

        flash('Berhasil menyimpan pengaturan')->success();

        return redirect()->route('home.setting');
    }

    public function updatePassword(Request $request)
    {
        if($request->password != $request->con_password) {
            flash('Konfirmasi password tidak sama')->error();
            return redirect()->route('home.setting');
        }

        $credentials = [
            'email' => auth()->user()->email,
            'password' => $request->old_password
        ];

        if(!\Auth::attempt($credentials)) {
            flash('Password lama anda salah')->error();
            return redirect()->route('home.setting');
        }

        $user = auth()->user();
        $user->password = \Hash::make($request->password);
        $user->save();
        
        flash('Berhasil merubah password')->success();
        return redirect()->route('home.setting');
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

    public function feed(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        if ($request->hasFile('image')) {
            $input['image'] = time().'_'.request()->image->getClientOriginalName();
            
            request()->image->move(public_path('uploads/images/'), $input['image']);
        }

        Feed::create($input);

        return redirect()->route('home');
    }

    public function reply(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        FeedReply::create($input);

        return redirect()->route('home');
    }
}
