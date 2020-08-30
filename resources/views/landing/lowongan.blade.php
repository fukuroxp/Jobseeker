@extends('layouts.landing')

@section('css')
    <style>
    </style>
@endsection

@section('content')
<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row bg-dark align-items-center p-2">
            <i class="fa fa-chevron-right fa-2x text-white"></i>
            <h2 class="text-white mt-1 mb-1 ml-1"> Lowongan Pekerjaan</h2>
        </div>
        <div class="mt-1 d-flex justify-content-start row">
            @foreach ($data as $item)
            <div class="card mr-1" style="width: 26rem;">
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
            @endforeach
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
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