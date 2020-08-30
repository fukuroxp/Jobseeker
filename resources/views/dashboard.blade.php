@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/users.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/card-analytics.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/tour/tour.css') }}">
@endsection

@section('content')
<div class="content-header row">
</div>
<div class="content-body">
    <div id="user-profile">
        <div class="row">
            <div class="col-12">
                <div class="profile-header mb-2">
                    <div class="relative">
                        <div class="cover-container">
                            <img class="img-fluid bg-cover rounded-0 w-100" style="height: 30rem" src="{{ asset('assets/images/3.jpg') }}" alt="User Profile Image">
                        </div>
                        <div class="profile-img-container d-flex align-items-center justify-content-between">
                            <img style="background: white" src="{{ auth()->user()->image ? asset('uploads/images/'.auth()->user()->image) : asset('uploads/images/profile.png') }}" class="rounded-circle img-border box-shadow-1" alt="Card image">
                            <div class="float-right">
                                <a type="button" href="{{ route('home.setting') }}" class="btn btn-icon btn-icon rounded-circle btn-primary mr-1">
                                    <i class="feather icon-edit-2 text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-1 mb-0">
                        <nav>
                            <h5>{{ auth()->user()->name }}</h5>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section id="profile-info">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['url' => route('home.feed'), 'method' => 'post', 'files' => true]) !!}
                            <fieldset class="form-label-group mb-50">
                                <textarea name="message" class="form-control" id="label-textarea" rows="3" placeholder="Apa yang anda pikirkan?"></textarea>
                                <label for="label-textarea">Apa yang anda pikirkan?</label>
                            </fieldset>
                            <fieldset class="form-label-group mb-50">
                                <input type="file" accept="image/*" name="image" class="form-control">
                            </fieldset>
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @foreach ($feeds as $value)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-center mb-1">
                                <div class="avatar mr-1">
                                    <img src="{{ $value->user->image ? asset('uploads/images/'.$value->user->image) : asset('uploads/images/profile.png') }}" alt="avtar img holder" height="45" width="45">
                                </div>
                                <div class="user-page-info">
                                    <p class="mb-0">{{ $value->user->name }}</p>
                                    <span class="font-small-2">{{ date('d M Y H:i', strtotime($value->created_at)) }}</span>
                                </div>
                            </div>
                            <p>{{ $value->message }}</p>
                            @if ($value->image)
                            <img class="img-fluid card-img-top rounded-sm mb-2" src="{{ asset('uploads/images/'.$value->image) }}" alt="avtar img holder">
                            @endif
                            <div class="d-flex justify-content-start align-items-center mb-1">
                                <div>
                                    <b>Komentar</b>
                                </div>
                                <p class="ml-auto d-flex align-items-center">
                                    <i class="feather icon-message-square font-medium-2 mr-50"></i>{{ count($value->replies) }}
                                </p>
                            </div>
                            @foreach ($value->replies as $reply)
                                <div class="d-flex justify-content-start align-items-center mb-1">
                                    <div class="avatar mr-50">
                                        <img src="{{ $reply->user->image ? asset('uploads/images/'.$reply->user->image) : asset('uploads/images/profile.png') }}" alt="Avatar" height="30" width="30">
                                    </div>
                                    <div class="user-page-info">
                                        <h6 class="mb-0">{{ $reply->user->name }}</h6>
                                        <span class="font-small-2">{{ $reply->message }}</span>
                                    </div>
                                    <div class="ml-auto cursor-pointer">
                                        <span class="font-small-2">{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                            {!! Form::open(['url' => route('home.reply'), 'method' => 'post']) !!}
                            {!! Form::hidden('feed_id', $value->id) !!}
                            <fieldset class="form-label-group mb-50">
                                <textarea name="message" class="form-control" id="label-textarea" rows="1" placeholder="Tulis Komentar"></textarea>
                                <label for="label-textarea">Tulis Komentar</label>
                            </fieldset>
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-3 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Materi Terbaru</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($materi as $value)
                                <div class="d-flex justify-content-start align-items-center mb-1">
                                    <div class="user-page-info">
                                        <h6 class="mb-0">{{ $value->name }}</h6>
                                        <span class="font-small-2">{{ $value->created_at->diffForHumans() }}</span>
                                    </div>
                                    <button type="button" data-href="{{ route('materi.show', [$value->id]) }}" class="btn btn-primary btn-icon ml-auto action-show"><i class="fa fa-download"></i></button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Vidio Terbaru</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($video as $value)
                                <div class="d-flex justify-content-start align-items-center mb-1">
                                    <div class="user-page-info">
                                        <h6 class="mb-0">{{ $value->name }}</h6>
                                        <span class="font-small-2">{{ $value->created_at->diffForHumans() }}</span>
                                    </div>
                                    <a type="button" href="{{ route('video.index') }}" class="btn btn-primary btn-icon ml-auto text-white"><i class="fa fa-play-circle"></i></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/js/scripts/pages/user-profile.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
    <script>
        $('.action-show').on("click",function(e){
            e.stopPropagation();
            $.ajax({
                url: $(this).data('href'),
                dataType: "json",
                success: function(data) {
                    window.open('uploads/file/'+data.file,'_blank');
                }
            })
        });
    </script>
@endsection