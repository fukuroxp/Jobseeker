@extends('layouts.landing')

@section('content')
<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-details-inner">
                    <div class="blog-detail-title">
                        <h2>{{ $data->title ?? '' }}</h2>
                        <p>{{ $data->user->name ?? '' }} <span>- {{ date('d M Y', strtotime($data->created_at)) }}</span></p>
                    </div>
                    <div class="blog-detail-more p-5">
                        {!! $data->content ?? '' !!}
                    </div>
                    <div class="posted-by">
                        <div class="pb-pic">
                            <img src="{{ $data->user->image ? asset('uploads/images/'.$data->user->image) : asset('uploads/images/profile.png') }}" class="rounded" height="64" width="64" alt="">
                        </div>
                        <div class="pb-text">
                            <a href="#">
                                <h5>{{ $data->user->name }}</h5>
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