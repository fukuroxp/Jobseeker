<?php

namespace App\Http\Controllers;

use App\Article;
use App\Business;
use App\Subscription;
use App\Job;
use App\JobApplicant;
use App\Slider;
use App\Sponsor;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $sliders = Slider::all();
        $articles = Article::latest()->take(4)->get();
        $vacancy = Business::whereHas('jobs')->latest()->take(4)->get();
        $sponsors1 = Sponsor::where('category', 1)->get();
        $sponsors2 = Sponsor::where('category', 2)->get();
        $videos = Video::orderBy('id', 'ASC')->get();
        // dd($vacancy);
        return view('home', compact('sliders', 'articles', 'vacancy', 'sponsors1', 'sponsors2', 'videos'));
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
        $data = Job::where('due_at', '>=', date("Y-m-d"))->orderBy('created_at', 'DESC')->paginate(10);

        return view('landing.lowongan', compact('data'));
    }
    
    public function lowongan_by_kota($id)
    {
        $data = Job::whereHas('city', function($q) use($id) {
            $q->where('city_job.city_id', $id);
        })->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('landing.lowongan', compact('data'));
    }
    
    public function lowongan_by_category($id)
    {
        $data = Job::whereHas('category', function($q) use($id) {
            $q->where('category_id', $id);
        })->orderBy('created_at', 'DESC')->paginate(10);
        
        return view('landing.lowongan', compact('data'));
    }

    public function showLowongan($id) {
        $data = Job::find($id);
        
        if($data->due_at >= date("Y-m-d")) {
            return back();
        }
        
        if($data->business_id == 14)
        {
            return view('job.request.aia', compact('data'));
        }
        else{
            return view('job.show', compact('data'));
        }
    }

    public function showBusiness($id) {
        $data = Business::find($id);

        return view('business.show', compact('data'));
    }

    public function showPengumuman() {
        $data = JobApplicant::where('status', 'approved')->latest()->get();

        if(Auth::check()){
            $accepted = JobApplicant::where([
                                    ['user_id', '=', auth()->user()->id],
                                    ['status', '=', 'approved']
                                ])->latest()->get();
            $available = $accepted->count() > 0;
            
            return view('landing.pengumuman', compact('data', 'accepted', 'available'));
        }

        return view('landing.pengumuman', compact('data'));
    }
    
    public function download($file)
    {
        $url=public_path('/uploads/file/1606106212.pdf');

        return response()->download($url);
    }
}
