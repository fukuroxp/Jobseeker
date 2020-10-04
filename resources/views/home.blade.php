@extends('layouts.landing')

@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($sliders as $slider)
        <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads/images/'. $slider->image) }}">
        </div>
        @endforeach
    </div>
</section>
<!-- Hero Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Headline</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($articles as $berita)
            <div class="col-lg-3 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ asset('uploads/images/'. $berita->thumbnail) }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                {{ $berita->created_at->format('d M, Y') }}
                            </div>
                        </div>
                        <a href="{{ route('show.artikel', [$berita->slug]) }}">
                            <h4>{{ $berita->title }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-control">
                        <ul>
                            <li class="active">Daftar Sponsor</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach ($sponsors as $sponsor)
                        <div class="product-item">
                            <div class="pi-pic">
                                <a target="_blank" href="{{ $sponsor->link }}"><img src="{{ asset('uploads/images/'. $sponsor->image) }}" alt=""></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                    <h1 class="mb-3">Lowongan Terbaru</h1>
                <div class="row">
                    @foreach ($vacancy as $item)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-latest-blog">
                            <div class="card mr-1" style="width: 16rem;">
                                <img class="card-img-top bg-secondary p-1" src="{{ ($item && $item->logo) ? asset('uploads/images/'.$item->logo) : asset('uploads/images/default.png') }}">
                                <div class="card-body">
                                    <h5 class="card-title btn-show text-primary" style="cursor: pointer;" data-href="{{ route('home.showBusiness', [$item->id]) }}"><b>{{ $item->name ?? '' }}</b></h5>
                                    <p class="card-text">{{ strip_tags($item->address) }}</p>
                                </div>
                                <hr class="mb-0">
                                <ul class="list-group list-group-flush">
                                    @foreach ($item->jobs as $job)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col">
                                                    <span class="btn-show text-primary" style="cursor: pointer;" data-href="{{ route('home.showLowongan', [$job->id]) }}"><b>{{ $job->title ?? '' }}</b></span>
                                                </div>
                                                <div class="col text-right">
                                                    <i class="fa fa-calendar fa-sm"></i> 16H
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <h1 class="mb-3">Berita Terbaru</h1>
                <div class="row">
                    @foreach ($articles as $berita)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-latest-blog">
                            <img src="{{ asset('uploads/images/'. $berita->thumbnail) }}" alt="">
                            <div class="latest-text">
                                <div class="tag-list">
                                    <div class="tag-item">
                                        <i class="fa fa-calendar-o"></i>
                                        {{ $berita->created_at->format('d M, Y') }}
                                    </div>
                                </div>
                                <a href="{{ route('show.artikel', [$berita->slug]) }}">
                                    <h4>{{ $berita->title }}</h4>
                                </a>
                                <p>{!! Str::limit($berita->content, 50, '.') !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
<div class="modal fade action-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
<div class="modal fade child-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
@endsection

@section('js')
    <script>
        $('.btn-show').on('click', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })
    </script>
@endsection