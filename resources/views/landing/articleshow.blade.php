@extends('layouts.landing')

@section('content')
<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-details-inner">
                    <div class="blog-detail-title">
                        <h2>{{ $article->title ?? '' }}</h2>
                        <p>{{ $article->user->name ?? '' }} <span>- {{ date('d M Y', strtotime($article->created_at)) }}</span></p>
                    </div>
                    <div class="blog-large-pic">
                        <img src="{{ $article->thumbnail ? asset('uploads/images/'.$article->thumbnail) : asset('uploads/images/article.jpg') }}" alt="">
                    </div>
                    <div class="blog-detail-more p-5">
                        {!! $article->content ?? '' !!}
                    </div>
                    <div class="posted-by">
                        <div class="pb-pic">
                            <img src="{{ $article->user->image ? asset('uploads/images/'.$article->user->image) : asset('uploads/images/profile.png') }}" class="rounded" height="64" width="64" alt="">
                        </div>
                        <div class="pb-text">
                            <a href="#">
                                <h5>{{ $article->user->name }}</h5>
                            </a>
                            <p>Anyone can steal your idea. But not with your execution</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
@endsection