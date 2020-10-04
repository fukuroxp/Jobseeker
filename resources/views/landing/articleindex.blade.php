@extends('layouts.landing')

@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($data as $berita)
        <div class="single-hero-items set-bg" data-setbg="{{ $berita->thumbnail ? asset('uploads/images/'.$berita->thumbnail) : asset('uploads/images/article.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <h1>{{ $berita->title ?? '' }}</h1>
                        <a href="{{ route('show.artikel', [$berita->slug]) }}" class="primary-btn">Baca lebih</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- Hero Section End -->
@endsection