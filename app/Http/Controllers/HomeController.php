<?php

namespace App\Http\Controllers;

use App\Article;
use App\Business;
use App\Subscription;
use App\Job;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function artikel($slug) {
        $data = Article::where('slug', $slug)->first();

        return view('landing.article', compact('data'));
    }

    public function lowongan() {
        $data = Business::whereHas('jobs')
                        ->get();

        $data = $data->map(function ($item, $key) {
            $isExpired = Subscription::isSubscriptionExpired($item->user_id);

            if(!$isExpired) return $item;
        });

        $data = $data->filter()->all();

        return view('landing.lowongan', compact('data'));
    }

    public function showLowongan($id) {
        $data = Job::find($id);

        return view('job.show', compact('data'));
    }

    public function showBusiness($id) {
        $data = Business::find($id);

        return view('business.show', compact('data'));
    }
}
