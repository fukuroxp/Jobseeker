<?php

namespace App\Utils;

use Illuminate\Mail\TransportManager;
use App\Setting;

class MailUtil extends TransportManager {

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;

        if( $settings = Setting::first() ){
            $settings = $settings->data;
            $this->app['config']['mail'] = [
                'driver'        => $settings['mail_driver'],
                'host'          => $settings['mail_host'],
                'port'          => $settings['mail_port'],
                'from'          => [
                    'address'   => $settings['mail_from_address'],
                    'name'      => $settings['mail_from_name']
                ],
                'encryption'    => $settings['mail_encryption'],
                'username'      => $settings['mail_username'],
                'password'      => $settings['mail_password'],
                'sendmail'      => [
                                        'transport' => 'sendmail',
                                        'path' => '/usr/sbin/sendmail -bs',
                                    ],
                'pretend'       => ''
           ];
       }

    }
}