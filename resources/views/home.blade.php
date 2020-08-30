@extends('layouts.landing')

@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <div class="single-hero-items set-bg" data-setbg="https://madiunkota.go.id/wp-content/uploads/2020/07/RI.jpeg">
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Blog Section Begin -->
<section class="blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                <div class="blog-sidebar">
                    @php
                        $lowongan = \App\Job::orderBy('created_at', 'DESC')->limit(10)->get();
                    @endphp
                    <div class="recent-post">
                        <h4>Lowongan Terbaru</h4>
                        <div class="recent-blog">
                            @foreach ($lowongan as $item)
                            <span style="cursor: pointer;"  data-href="{{ route('home.showLowongan', [$item->id]) }}" class="rb-item btn-show">
                                <div class="rb-pic">
                                    <img src="{{ ($item->business && $item->business->logo) ? asset('uploads/images/'.$item->business->logo) : asset('uploads/images/default.png') }}" alt="" height="64" width="64">
                                </div>
                                <div class="rb-text">
                                    <h6>{{ $item->title ?? '' }}</h6>
                                    <p>{{ $item->business->name ?? '' }} <span>- {{ date('d M Y', strtotime($item->created_at)) }}</span></p>
                                </div>
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @php
                $articles = \App\Article::all();
            @endphp
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="row">
                    @foreach ($articles as $item)
                        @php
                            $xpath = new DOMXPath(@DOMDocument::loadHTML($item->content));
                            $image = $xpath->evaluate("string(//img/@src)");
                        @endphp
                        <div class="col-lg-6 col-sm-6">
                            <div class="blog-item">
                                <div class="bi-pic">
                                    <img src="{{ $image ?? 'https://www.impossible.sg/wp-content/uploads/2013/11/seo-article-writing.jpg' }}" alt="">
                                </div>
                                <div class="bi-text">
                                    <a href="{{ route('home.artikel', ['slug' => $item->slug]) }}">
                                        <h4 class="mb-0">{{ $item->title ?? '' }}</h4>
                                    </a>
                                    <span>{{ \Str::limit(strip_tags($item->content), 100) }}</span>
                                    <p class="mt-2">{{ $item->user->name ?? '' }}<span> - {{ date('d M Y', strtotime($item->created_at)) }}</span></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
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