@extends('layouts.landing')

@section('content')
<!-- Women Banner Section Begin -->
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
                    @foreach ($data as $sponsor)
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('uploads/images/'. $sponsor->image) }}" alt="">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End -->
@endsection