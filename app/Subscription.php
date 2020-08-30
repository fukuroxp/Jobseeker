<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = ['id'];

    public function package() {
        return $this->belongsTo(Package::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function getDateLastActiveSubscription($user_id) {
        $data = Subscription::where(['status' => 'approved', 'user_id' => $user_id])->orderBy('created_at', 'DESC')->first();

        if(!$data) {
            return date('Y-m-d');
        }

        return (($data && (date('Y-m-d') > date('Y-m-d', strtotime($data->expired_at)))) ? date('Y-m-d') : $data->expired_at);
    }

    public static function isSubscriptionExpired($user_id) {
        $lastDateActivesubs = self::getDateLastActiveSubscription($user_id);
        
        return $lastDateActivesubs <= date('Y-m-d');
    }
}
