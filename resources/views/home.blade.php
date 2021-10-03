@extends('layouts.landing')

@section('content')
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
 <style>
     .carousel-control-prev-icon,
       .carousel-control-next-icon {
           background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' stroke='%2322313F' stroke-miterlimit='10' stroke-width='2' viewBox='0 0 34.589 66.349'%3E%3Cpath d='M34.168.8 1.7 33.268 34.168 65.735'/%3E%3C/svg%3E");
           height: 100px;
       }

       .carousel-control-next-icon {
           transform: rotate(180deg);
       }

       /* medium - display 4  */
       @media (min-width: 768px) {
           #gallery .carousel-inner .carousel-item-right.active,
           #gallery .carousel-inner .carousel-item-next {
               transform: translateX(33.33333%);
           }

           #gallery .carousel-inner .carousel-item-left.active,
           #gallery .carousel-inner .carousel-item-prev {
               transform: translateX(-33.33333%);
           }
       }

       /* large - display 5 */
       @media (min-width: 992px) {
           #gallery .carousel-inner .carousel-item-right.active,
           #gallery .carousel-inner .carousel-item-next {
               transform: translateX(20%);
           }

           #gallery .carousel-inner .carousel-item-left.active,
           #gallery .carousel-inner .carousel-item-prev {
               transform: translateX(-20%);
           }
       }

       #gallery .carousel-inner .carousel-item-right,
       #gallery .carousel-inner .carousel-item-left{
           transform: translateX(0);
       }


       /* gallery slider */
       #gallery .carousel-inner .carousel-item.active,
       #gallery .carousel-inner .carousel-item-next,
       #gallery .carousel-inner .carousel-item-prev {
           display: flex;
       }

       @media (max-width: 768px) {
           #gallery .carousel-inner .carousel-item > div {
               display: none;
           }
           #gallery .carousel-inner .carousel-item > div:first-child {
               display: block;
               text-align: center;
           }
       }
       
       @media (min-width: 768px) {
           #gallery2 .carousel-inner .carousel-item-right.active,
           #gallery2 .carousel-inner .carousel-item-next {
               transform: translateX(33.33333%);
           }

           #gallery2 .carousel-inner .carousel-item-left.active,
           #gallery2 .carousel-inner .carousel-item-prev {
               transform: translateX(-33.33333%);
           }
       }

       /* large - display 5 */
       @media (min-width: 992px) {
           #gallery2 .carousel-inner .carousel-item-right.active,
           #gallery2 .carousel-inner .carousel-item-next {
               transform: translateX(20%);
           }

           #gallery2 .carousel-inner .carousel-item-left.active,
           #gallery2 .carousel-inner .carousel-item-prev {
               transform: translateX(-20%);
           }
       }

       #gallery2 .carousel-inner .carousel-item-right,
       #gallery2 .carousel-inner .carousel-item-left{
           transform: translateX(0);
       }


       /* gallery slider */
       #gallery2 .carousel-inner .carousel-item.active,
       #gallery2 .carousel-inner .carousel-item-next,
       #gallery2 .carousel-inner .carousel-item-prev {
           display: flex;
       }

       @media (max-width: 768px) {
           #gallery2 .carousel-inner .carousel-item > div {
               display: none;
           }
           #gallery2 .carousel-inner .carousel-item > div:first-child {
               display: block;
               text-align: center;
           }
       }
 </style>
 <style>
     .carousel-video-inner {
  text-align: center;
}
 </style>
 <style>
        .w-90 {
           width: 90%;
       }
       .col-5,
       .col-sm-5,
       .col-md-5,
       .col-lg-5,
       .col-xl-5 {
           position: relative;
           width: 100%;
           padding-right: 15px;
           padding-left: 15px;
       }

       .col-5 {
           flex: 0 0 20%;
           max-width: 20%;
       }

       @media (min-width: 576px){
           .col-sm-5 {
               flex: 0 0 20%;
               max-width: 20%;
           }
       }
       @media (min-width: 768px){
           .col-md-5 {
               flex: 0 0 20%;
               max-width: 20%;
           }
       }
       @media (min-width: 992px){
           .col-lg-5 {
               flex: 0 0 20%;
               max-width: 20%;
           }
       }
       @media (min-width: 1200px){
           .col-xl-5 {
               flex: 0 0 20%;
               max-width: 20%;
           }
       }
 </style>
 <style>
       .youtube-carousel{
           border: 4px solid #ffffff;
       }

       .video-container {
           position: relative; /* keeps the aspect ratio */
           padding-bottom: 56.25%; /* fine tunes the video positioning */
           padding-top: 60px; overflow: hidden;
           margin-bottom: -1px;
           margin-right: -1px;
       }

       .video-container iframe,
       .video-container object,
       .video-container embed {
           position: absolute;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
       }

       .carousel-control .glyphicon-chevron-left{
           top:35%;
           font-size: 20px;
           left:5%;
           margin: 0;
       }

       .carousel-control .glyphicon-chevron-right{
           top:35%;
           font-size: 20px;
           left:33%;
           margin: 0;
       }

       .carousel-control.left, .carousel-control.right {
           background-image: none;
           color: #ffffff;
           top: 50%;
           transform: translate(0,-50%);
           -webkit-transform: translate(0,-50%);
           -ms-transform: translate(0,-50%);
           opacity: 1;
           height:120px;
       }

       .controls{
           display: none;
       }

       .carousel-control:hover {
           text-decoration: none;
           filter: alpha(opacity=60);
           outline: 0;
           opacity: 0.6;
       }

       .left-button {
           height:70px;
           width:35px;
           border-radius: 0 90px 90px 0;
           top: 50%;
           -webkit-transform: translate(0,-50%);
           -ms-transform: translate(0,-50%);
           transform: translate(0,-50%);
           -moz-border-radius: 0 90px 90px 0;
           -webkit-border-radius: 0 90px 90px 0;
           background-color: #4CA3DD;
           display: inline-block;
           position: relative;
           float:left;
           /*subpixel bug*/
           margin-left: -1px;
       }

       .right-button {
           height:70px;
           width:35px;
           border-radius: 90px 0 0 90px;
           top: 50%;
           -webkit-transform: translate(0,-50%);
           -ms-transform: translate(0,-50%);
           transform: translate(0,-50%);
           -moz-border-radius: 90px 0 0 90px;
           -webkit-border-radius: 90px 0 0 90px;
           background-color: #4CA3DD;
           display: inline-block;
           position: relative;
           float:right;
           /*subpixel bug*/
           margin-right: -1px;
       }


       .carousel-caption {
           display: none;
           background: none repeat scroll 0 0 #4CA3DD;
           bottom: 0;
           font-size: 12px;
           text-align: center;
           opacity: 1;
           padding:7px 30px 7px;
           text-transform: uppercase;
           z-index:11;
           pointer-events:none;
       }

       @media screen and (min-width: 768px) {
           .right-button {
               height:120px;
               width:60px;
               border-radius: 90px 0 0 90px;
               -moz-border-radius: 90px 0 0 90px;
               -webkit-border-radius: 90px 0 0 90px;
               display: inline-block;
               position: relative;
               float:right;
           }

           .left-button {
               height:120px;
               width:60px;
               border-radius: 0 90px 90px 0;
               -moz-border-radius: 0 90px 90px 0;
               -webkit-border-radius: 0 90px 90px 0;
               display: inline-block;
               position: relative;
               float:left;
           }

           .carousel-control .glyphicon-chevron-left{
               top:35%;
               font-size: 35px;
               left:5%;
           }

           .carousel-control .glyphicon-chevron-right{
               top:35%;
               font-size: 35px;
               left:35%;
           }

           .carousel-caption {
               font-size: 18px;
               padding:15px 20px 15px;
           }
       }
       @media screen and (min-width: 992px) {
           .carousel-caption {
               font-size: 18px;
               padding:15px 20px 15px;
           }
       }
   </style>
   <style>
       .container {
           overflow: hidden;}
       .slider {
           animation: slidein 7s linear infinite;
           white-space: nowrap;}
       .logos {
           width: 100%;
           display: inline-block;
           margin: 0px 0;}
       .fab {
           width: calc(100% / 5);
           animation: fade-in 0.5s
           /*cubic-bezier(0.455, 0.03, 0.515, 0.955) forwards;*/
       }
       @keyframes slidein {
           from {
               transform: translate3d(0, 0, 0);
           }
           to {
               transform: translate3d(-100%, 0, 0);
           }
       }

       @keyframes fade-in {
           0% {
               opacity: 0;
           }
           100% {
               opacity: 1;
           }
       }
   </style>
<!-- Revolution slider start -->
<div class="tp-banner-container">
  <div class="tp-banner" >
    <ul>
      <!--Slide-->
      @foreach ($sliders as $slider)
      <li data-slotamount="7" data-transition="3dcurtain-vertical" data-masterspeed="1000" data-saveperformance="on"> <img alt="Your alt text" src="{{ asset('uploads/images/'. $slider->image) }}" data-lazyload="{{ asset('uploads/images/'. $slider->image) }}">
        <!--<div class="caption lfl large-title tp-resizeme slidertext1" data-x="left" data-y="100" data-speed="600" data-start="1600">Search Your Job<br />-->
        <!--  In your Area</div>-->
        <!--<div class="caption lfb large-title tp-resizeme sliderpara" data-x="left" data-y="200" data-speed="600" data-start="2800">Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br />-->
        <!--  Lorem Ipsum has been the industry's standard dummy text ever since.</div>-->
        <!--<div class="caption lfl large-title tp-resizeme slidertext5" data-x="left" data-y="280" data-speed="600" data-start="3500"><a href="#.">Contact Us</a></div>-->
      </li>
      @endforeach
      <!--Slide end-->     
    </ul>
  </div>
</div>
<!-- Revolution slider end --> 
<!-- Top Employers start -->
<div class="section greybg">
  <div class="container"> 
    <!-- title start -->
    <div class="titleTop">
      <!--<div class="subtitle">Here You Can See</div>-->
      <h3>Sponsorship & Partnership</h3>
    </div>
    <!-- title end -->
    <div class="container h-100">
            <div class="row mx-auto h-100">
                <div id="gallery" class="carousel slide w-100 align-self-center" data-ride="carousel">
                    <div class="carousel-inner mx-auto w-90" role="listbox" data-toggle="modal" data-target="#lightbox">
                         @foreach ($sponsors1 as $sponsor)
                        <div class="carousel-item">
                            <div class="col-lg-5 col-md-4">
                                <img class="img-fluid" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="1">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="w-100">
                        <a class="carousel-control-prev w-auto" href="#gallery" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next w-auto" href="#gallery" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container h-100">
            <div class="row mx-auto h-100">
                <div id="gallery2" class="carousel slide w-100 align-self-center" data-ride="carousel">
                    <div class="carousel-inner mx-auto w-90" role="listbox" data-toggle="modal" data-target="#lightbox">
                         @foreach ($sponsors2 as $sponsor)
                        <div class="carousel-item">
                            <div class="col-lg-5 col-md-4">
                                <img class="img-fluid" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="1">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="w-100">
                        <a class="carousel-control-prev w-auto" href="#gallery2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next w-auto" href="#gallery2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <!--<div class="container">-->
    <!--        <div class="slider">-->
    <!--            <div class="logos d-flex">-->
    <!--                 @foreach ($sponsors1 as $sponsor)-->
    <!--                <div class="col-5">-->
    <!--                    <a target="_blank" href="{{ $sponsor->link }}">-->
    <!--                        <img class="img-fluid" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="4">-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                 @endforeach-->
    <!--                  @foreach ($sponsors1 as $sponsor)-->
    <!--                <div class="col-5">-->
    <!--                    <a target="_blank" href="{{ $sponsor->link }}">-->
    <!--                        <img class="img-fluid" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="4">-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                 @endforeach-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <br><br>-->
    <!--    @if($sponsors2->count() > 5)-->
    <!--     <div class="container">-->
    <!--        <div class="slider">-->
    <!--            <div class="logos d-flex">-->
    <!--                 @foreach ($sponsors2 as $sponsor)-->
    <!--                <div class="col-5">-->
    <!--                    <a target="_blank" href="{{ $sponsor->link }}">-->
    <!--                        <img class="img-fluid" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="4">-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                 @endforeach-->
    <!--                  @foreach ($sponsors2 as $sponsor)-->
    <!--                <div class="col-5">-->
    <!--                    <a target="_blank" href="{{ $sponsor->link }}">-->
    <!--                        <img class="img-fluid" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="4">-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                 @endforeach-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    @else-->
    <!--    <div class="container">-->
    <!--        <div >-->
    <!--            <div class="logos d-flex" style="justify-content: center; float: center;">-->
    <!--                 @foreach ($sponsors2 as $sponsor)-->
    <!--                <div class="col-5">-->
    <!--                    <a target="_blank" href="{{ $sponsor->link }}">-->
    <!--                        <img class="img-fluid" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="4">-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--                 @endforeach-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    @endif-->
          
        <!--@if($sponsors2->count() >= 1)-->
        <!--<div class="container h-100 mt-4">-->
        <!--    <div class="row mx-auto h-100">-->
        <!--        <div id="gallery2" class="carousel slide w-100 align-self-center" data-ride="carousel">-->
        <!--            <div class="carousel-inner mx-auto w-90" role="listbox" data-toggle="modal" data-target="#lightbox">-->
        <!--                @foreach ($sponsors2 as $sponsor)-->
        <!--                <div class="carousel-item">-->
        <!--                    <div class="col-lg-5 col-md-4">-->
        <!--                       <a target="_blank" href="{{ $sponsor->link }}">-->
        <!--                          <img class="img-fluid" style="height:65px; width:100%;" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" data-target="#lightbox-gallery" data-slide-to="4">-->
        <!--                        </a>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                 @endforeach-->
        <!--            </div>-->
        <!--            <div class="w-100">-->
        <!--                <a class="carousel-control-prev w-auto" href="#gallery2" role="button" data-slide="prev">-->
        <!--                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
        <!--                    <span class="sr-only">Previous</span>-->
        <!--                </a>-->
        <!--                <a class="carousel-control-next w-auto" href="#gallery2" role="button" data-slide="next">-->
        <!--                    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
        <!--                    <span class="sr-only">Next</span>-->
        <!--                </a>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--@endif-->
        
        <br><br><br><br>
        
        <div class="container">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">
          <div class="carousel-item active">
              <div class="carousel-video-inner">
              <iframe width="560" height="315" src="https://www.youtube.com/embed/iLs9TLFzLzU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          </div>
          @foreach($videos as $video)
          <div class="carousel-item">
            <div class="carousel-video-inner">
              <div id="video-player" data-video-id="{{$video->link}}"></div>
            </div>
          </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  
        <!--<div class="container mt-4">-->
        <!--<div class="row">-->
        <!--    <div class="col-sm-8 col-sm-offset-2">-->
        <!--        <div id="random_number1" class="carousel slide youtube-carousel"  data-ride="carousel" data-interval="false">-->
        <!--            <div class="carousel-inner">-->
        <!--                @php $id = \App\Video::orderBy('id', 'asc')->first(); @endphp-->
                        
        <!--                @foreach($videos as $video)-->
        <!--                    <div class="video-container item {{$id->id == $video->id ? 'active' : '-'}}">-->
        <!--                        <div class="youtube-video" id='{{$video->link}}'></div>-->
        <!--                        <div class="carousel-caption">{{$video->name}}</div>-->
        <!--                    </div>-->
        <!--                @endforeach-->
        <!--            </div>-->
        <!--            <div class="controls">-->
        <!--                <a class="left carousel-control" href="#random_number1" data-slide="prev">-->
        <!--                    <div class="left-button">-->
        <!--                        <div class="glyphicon glyphicon-chevron-left"></div>-->
        <!--                    </div>-->
        <!--                </a>-->
        <!--                <a class="right carousel-control" href="#random_number1" data-slide="next">-->
        <!--                    <div class="right-button">-->
        <!--                        <div class="glyphicon glyphicon-chevron-right"></div>-->
        <!--                    </div>-->
        <!--                </a>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
    <!--<ul class="employerList">-->
      <!--employer-->
    <!--  @foreach ($sponsors1 as $sponsor)-->
    <!--  <li data-toggle="tooltip" data-placement="top" title="{{ $sponsor->name }}" data-original-title="{{ $sponsor->name }}"><a target="_blank" href="{{ $sponsor->link }}"><img style="height:62.5px; width:50000000000000000px;" src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="{{ $sponsor->name }}" /></a></li>-->
    <!--  @endforeach-->
    <!--</ul>-->
  </div>
</div>
<!-- Top Employers ends --> 

<!-- Popular Searches start -->
<div class="section">
  <div class="container"> 
    <!-- title start -->
    <div class="titleTop">
      <h3>Lowongan <span>Populer</span></h3>
    </div>
    <!-- title end -->
    <div class="topsearchwrap row">
      <div class="col-md-6"> 
        <!--Categories start-->
        <h4>Cari Berdasarkan Kategori</h4>
        <ul class="row catelist">
        @foreach(App\Category::get()->random(16) as $cat)
          <li class="col-md-6 col-sm-6"><a href="{{route('home.showLowonganByCategory', $cat->id)}}">{{$cat->nama}} <span>({{$cat->job->count()}})</span></a></li>
        @endforeach
        </ul>
        <!--Categories end--> 
      </div>
      <div class="col-md-6"> 
        <!--Cities start-->
        <h5>Cari Berdasarkan Kota</h5>
        <ul class="row catelist">
          <li class="col-md-4 col-sm-4 col-xs-6"><a href="{{route('home.showLowonganByCity', 159)}}">Surabaya </a></li>
          <li class="col-md-4 col-sm-4 col-xs-6"><a href="{{route('home.showLowonganByCity', 156)}}">Sidoarjo </a></li>
         @foreach(App\City::where('province_id', 11)->orWhere('province_id', 9)->orWhere('province_id', 10)->orWhere('province_id', 5)->orWhere('province_id', 6)->get()->random(27) as $ct)
          <li class="col-md-4 col-sm-4 col-xs-6"><a href="{{route('home.showLowonganByCity', $ct->id)}}">{{$ct->title}} </a></li>
         @endforeach
         <!--({{$ct->job->count()}})-->
        </ul>
        <!--Cities end--> 
      </div>
    </div>
  </div>
</div>
<!-- Popular Searches ends --> 

<!-- Featured Jobs start -->
<div class="section greybg">
  <div class="container"> 
    <!-- title start -->
    <div class="titleTop">
      <h3>Lowongan <span>Terbaru</span></h3>
    </div>
    <!-- title end --> 
    
    <!--Featured Job start-->
    <ul class="jobslist row">
      <!--Job start-->
      @foreach(App\Job::where('due_at', '>=', date("Y-m-d"))->orderBy('created_at', 'desc')->limit(12)->get() as $job)
      <li class="col-md-6">
        <div class="jobint">
          <div class="row">
            <div class="col-md-2 col-sm-2"><img src="{{ asset('uploads/images/'. $job->business->logo) }}" alt="{{$job->business->name}}" height="37.5px;"/></div>
            <div class="col-md-7 col-sm-7">
              <h6><a class="btn-show" style="cursor: pointer;" data-href="{{ route('home.showLowongan', [$job->id]) }}">{{$job->title}}</a></h6>
              <div class="company"><a data-href="{{ route('home.showLowongan', [$job->id]) }}">{{$job->study}}</a></div>
              @if(\Str::contains($job->type, 'Fulltime') )
              <div class="jobloc"><label class="fulltime">{{$job->type}}</label>
                @if(count($job->city) > 0 )- 
                    @foreach($job->city as $city)
                    <span>{{$city->title}}</span>
                    @endforeach
                @else- 
                    <span>-</span>
                @endif
                - 
                <span>{{date('d/m/Y', strtotime($job->due_at))}}</span>
              </div>
              @elseif(\Str::contains($job->type, 'Parttime') )
              <div class="jobloc"><label class="parttime">{{$job->type}}</label>   - 
                @if(count($job->city) > 0)- 
                    @foreach($job->city as $city)
                    <span>{{$city->title}}</span>
                    @endforeach
                @else- 
                    <span>-</span>
                @endif
                - 
                <span>{{date('d/m/Y', strtotime($job->due_at))}}</span>
              </div>
              @endif
            </div>
            @if (auth()->user())
                @if(auth()->user()->hasRole('Jobseeker'))
                <div class="col-md-3 col-sm-3"><a data-dismiss="modal" data-href="{{ route('jobs.getApply', $job->id) }}" class="applybtn btn-apply">Apply Now</a></div>
                @endif
            @else
                <div class="col-md-3 col-sm-3"><a href="{{ route('login') }}" class="applybtn">Apply Now</a></div>
            @endif
            
          </div>
        </div>
      </li>
      @endforeach
      <!--Job end--> 
      
    </ul>
    <!--Featured Job end--> 
    
    <!--button start-->
    <div class="viewallbtn"><a href="{{route('home.lowongan')}}">Lihat Semua Lowongan</a></div>
    <!--button end--> 
  </div>
</div>
<!-- Featured Jobs ends --> 

<!-- Video start -->
<!--<div class="videowraper section">-->
<!--  <div class="container"> -->
    <!-- title start -->
<!--    <div class="titleTop">-->
<!--      <h3>Lihat Video <span>Kami</span></h3>-->
<!--    </div>-->
    <!-- title end -->
    
    
<!--    <a href="#"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a> </div>-->
<!--</div>-->
<!-- Video end --> 

<!-- Latest Blog Section Begin -->
<!--<section class="latest-blog spad">-->
    <!--<div class="container">-->
    <!--    <div class="row">-->
    <!--        <div class="col-lg-12">-->
    <!--            <div class="section-title">-->
    <!--                <h2>Headline</h2>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="row">-->
    <!--        @foreach ($articles as $berita)-->
    <!--        <div class="col-lg-3 col-md-6">-->
    <!--            <div class="single-latest-blog">-->
    <!--                <img src="{{ asset('uploads/images/'. $berita->thumbnail) }}" alt="">-->
    <!--                <div class="latest-text">-->
    <!--                    <div class="tag-list">-->
    <!--                        <div class="tag-item">-->
    <!--                            <i class="fa fa-calendar-o"></i>-->
    <!--                            {{ $berita->created_at->format('d M, Y') }}-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <a href="{{ route('show.artikel', [$berita->slug]) }}">-->
    <!--                        <h4>{{ $berita->title }}</h4>-->
    <!--                    </a>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        @endforeach-->
    <!--    </div>-->
    <!--</div>-->
    
    
    
<!--    <div class="container mt-4">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12 col-md-12">-->
<!--                    <h1 class="mb-3 text-center">Lowongan</h1>-->
<!--                <div class="row">-->
<!--                    @foreach ($vacancy as $item)-->
<!--                    <div class="col-lg-3 col-md-3">-->
<!--                        <div class="single-latest-blog">-->
<!--                            <div class="card mr-1" style="width: 16rem;">-->
<!--                                <img class="card-img-top bg-secondary p-1" src="{{ ($item && $item->logo) ? asset('uploads/images/'.$item->logo) : asset('uploads/images/default.png') }}" style="height: 175px;">-->
<!--                                <div class="card-body">-->
<!--                                    <h5 class="card-title btn-show text-primary" style="cursor: pointer;" data-href="{{ route('home.showBusiness', [$item->id]) }}"><b>{{ $item->name ?? '' }}</b></h5>-->
<!--                                    <p class="card-text">{{ Str::limit(strip_tags($item->address),25) }}</p>-->
<!--                                </div>-->
<!--                                <hr class="mb-0">-->
<!--                                <ul class="list-group list-group-flush">-->
<!--                                    @foreach ($item->jobs as $job)-->
<!--                                        <li class="list-group-item">-->
<!--                                            <div class="row">-->
<!--                                                <div class="col">-->
<!--                                                    <span class="btn-show text-primary" style="cursor: pointer;" data-href="{{ route('home.showLowongan', [$job->id]) }}">{{ Str::limit($job->title, 15) ?? '' }}</span>-->
<!--                                                </div>-->
<!--                                                <div class="col text-right">-->
<!--                                                    <i class="fa fa-calendar fa-sm"></i> <small>{{date('d-m-Y', strtotime($job->due_at))}}</small>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </li>-->
<!--                                    @endforeach-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    @endforeach-->
<!--                </div>-->
<!--            </div>-->
            <!--<div class="col-lg-6 col-md-6">-->
            <!--    <h1 class="mb-3">Berita Terbaru</h1>-->
            <!--    <div class="row">-->
            <!--        @foreach ($articles as $berita)-->
            <!--        <div class="col-lg-6 col-md-6">-->
            <!--            <div class="single-latest-blog">-->
            <!--                <img src="{{ asset('uploads/images/'. $berita->thumbnail) }}" alt="">-->
            <!--                <div class="latest-text">-->
            <!--                    <div class="tag-list">-->
            <!--                        <div class="tag-item">-->
            <!--                            <i class="fa fa-calendar-o"></i>-->
            <!--                            {{ $berita->created_at->format('d M, Y') }}-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <a href="{{ route('show.artikel', [$berita->slug]) }}">-->
            <!--                        <h4>{{ $berita->title }}</h4>-->
            <!--                    </a>-->
            <!--                    <p>{!! Str::limit($berita->content, 50, '.') !!}</p>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        @endforeach-->
            <!--    </div>-->
            <!--</div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!-- Latest Blog Section End -->
<div class="modal fade action-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
<div class="modal fade child-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
@endsection

@section('js')
<script>
    $(function() {
  $(".carousel").on("slide.bs.carousel", function(e) {
    var prev = $(this)
      .find(".active")
      .index();
    var next = $(e.relatedTarget).index();
    var video = $("#video-player")[0];
    var videoSlide = $("#video-player")
      .closest(".carousel-item")
      .index();
    if (next === videoSlide) {
      if (video.tagName == "IFRAME") {
        player.playVideo();
      } else {
        createVideo(video);
      }
    } else {
      if (typeof player !== "undefined") {
        player.pauseVideo();
      }
    }
  });
});

function createVideo(video) {
  var youtubeScriptId = "youtube-api";
  var youtubeScript = document.getElementById(youtubeScriptId);
  var videoId = video.getAttribute("data-video-id");

  if (youtubeScript === null) {
    var tag = document.createElement("script");
    var firstScript = document.getElementsByTagName("script")[0];

    tag.src = "https://www.youtube.com/iframe_api";
    tag.id = youtubeScriptId;
    firstScript.parentNode.insertBefore(tag, firstScript);
  }

  window.onYouTubeIframeAPIReady = function() {
    window.player = new window.YT.Player(video, {
      videoId: videoId,
      playerVars: {
        autoplay: 1,
        modestbranding: 1,
        rel: 0
      }
    });
  };
}
</script>
    <!--<script>-->
        //Start Youtube API
    <!--    var tag = document.createElement('script');-->
    <!--    tag.src = "https://www.youtube.com/iframe_api";-->
    <!--    var firstScriptTag = document.getElementsByTagName('script')[0];-->
    <!--    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);-->

    <!--    var youtubeReady = false;-->

        //Variable for the dynamically created youtube players
    <!--    var players= new Array();-->
    <!--    var isPlaying = false;-->
    <!--    function onYouTubeIframeAPIReady(){-->
            //The id of the iframe and is the same as the videoId
    <!--        jQuery(".youtube-video").each(function(i, obj)  {-->
    <!--            players[obj.id] = new YT.Player(obj.id, {-->
    <!--                videoId: obj.id,-->
    <!--                playerVars: {-->
    <!--                    controls: 2,-->
    <!--                    rel:0,-->
    <!--                    autohide:1,-->
    <!--                    showinfo: 0 ,-->
    <!--                    modestbranding: 1,-->
    <!--                    wmode: "transparent",-->
    <!--                    html5: 1-->
    <!--                },-->
    <!--                events: {-->
    <!--                    'onStateChange': onPlayerStateChange-->
    <!--                }-->
    <!--            });-->
    <!--        });-->
    <!--        youtubeReady = true;-->
    <!--    }-->


    <!--    function onPlayerStateChange(event) {-->
    <!--        var target_control =  jQuery(event.target.getIframe()).parent().parent().parent().find(".controls");-->

    <!--        var target_caption = jQuery(event.target.getIframe()).parent().find(".carousel-caption");-->
    <!--        switch(event.data){-->
    <!--            case -1:-->
    <!--                jQuery(target_control).fadeIn(500);-->
    <!--                jQuery(target_control).children().unbind('click');-->
    <!--                break-->
    <!--            case 0:-->
    <!--                jQuery(target_control).fadeIn(500);-->
    <!--                jQuery(target_control).children().unbind('click');-->
    <!--                break;-->
    <!--            case 1:-->
    <!--                jQuery(target_control).children().click(function () {return false;});-->
    <!--                jQuery(target_caption).fadeOut(500);-->
    <!--                jQuery(target_control).fadeOut(500);-->
    <!--                break;-->
    <!--            case 2:-->
    <!--                jQuery(target_control).fadeIn(500);-->
    <!--                jQuery(target_control).children().unbind('click');-->
    <!--                break;-->
    <!--            case 3:-->
    <!--                jQuery(target_control).children().click(function () {return false;});-->
    <!--                jQuery(target_caption).fadeOut(500);-->
    <!--                jQuery(target_control).fadeOut(500);-->
    <!--                break;-->
    <!--            case 5:-->
    <!--                jQuery(target_control).children().click(function () {return false;});-->
    <!--                jQuery(target_caption).fadeOut(500);-->
    <!--                jQuery(target_control).fadeOut(500);-->
    <!--                break;-->
    <!--            default:-->
    <!--                break;-->
    <!--        }-->
    <!--    };-->

    <!--    jQuery(window).bind('load', function(){-->
    <!--        jQuery(".carousel-caption").fadeIn(500);-->
    <!--        jQuery(".controls").fadeIn(500);-->
    <!--    });-->

    <!--    jQuery('.carousel').bind('slid.bs.carousel', function (event) {-->
    <!--        jQuery(".controls").fadeIn(500);-->
    <!--    });-->
    <!--</script>-->
    <script>
        jQuery('#gallery').carousel({
  interval: 2000
})

// Modify each slide to contain five columns of images
jQuery('#gallery.carousel .carousel-item').each(function(){
    var minPerSlide = 4;
    var next = jQuery(this).next();
    if (!next.length) {
    next = jQuery(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo(jQuery(this));
    
    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
        	next = jQuery(this).siblings(':first');
      	}
        
        next.children(':first-child').clone().appendTo(jQuery(this));
      }
});

// Initialize carousel
jQuery( ".carousel-item:first-of-type" ).addClass( "active" );
jQuery( ".carousel-indicators:first-child" ).addClass( "active" );
    </script>
    <script>
       jQuery('#gallery2').carousel({
           interval: 2000
       })

       // Modify each slide to contain five columns of images
       jQuery('#gallery2.carousel .carousel-item').each(function(){
           var minPerSlide = 4;
           var next = jQuery(this).next();
           if (!next.length) {
               next = jQuery(this).siblings(':first');
           }
           next.children(':first-child').clone().appendTo(jQuery(this));

           for (var i=0;i<minPerSlide;i++) {
               next=next.next();
               if (!next.length) {
                   next = jQuery(this).siblings(':first');
               }

               next.children(':first-child').clone().appendTo(jQuery(this));
           }
       });

       // Initialize carousel
       jQuery( ".carousel-item:first-of-type" ).addClass( "active" );
       jQuery( ".carousel-indicators:first-child" ).addClass( "active" );
   </script>
@endsection