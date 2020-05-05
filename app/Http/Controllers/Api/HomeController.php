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
}
