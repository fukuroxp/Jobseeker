<?php

namespace App\Http\Controllers;

use App\Article;
use App\Business;
use App\Subscription;
use App\Job;
use App\Slider;
use App\Sponsor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $sliders = Slider::all();
        $articles = Article::latest()->take(4)->get();
        $vacancy = Business::whereHas('jobs')->latest()->take(4)->get();
        $sponsors = Sponsor::all();
        // dd($vacancy);
        return view('home', compact('sliders', 'articles', 'vacancy', 'sponsors'));
    }

    public function artikelIndex() {
        $data = Article::all();
        // dd($data);

        return view('landing.articleindex', compact('data'));
    }

    public function artikelShow(Article $article) {

        return view('landing.articleshow', compact('article'));
    }

    public function lowongan() {
        $data = Business::whereHas('jobs')->get();

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

    public function showPengumuman() {

        return view('pengumuman_lomba');
    }
}
