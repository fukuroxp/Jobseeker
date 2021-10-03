@extends('layouts.landing')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    
    <!-- Css Styles -->

    <link rel="stylesheet" href="{{ asset('fashi/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fashi/css/slicknav.min.css') }}" type="text/css">

    
    
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@endsection

@section('content')
<br><br><br><br>
<div class="banner-section spad">
    @if(Auth::check() && $available)
    <div class="container">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading text-center">Selamat {{ auth()->user()->name }}</h4>
            <p class="text-center">Lamaran yang anda ajukan telah diterima.</p>
            <hr>
            <p class="text-center">Lihat list pada tabel dibawah ini. Apabila ada yang ingin ditanyakan silahkan kontak perusahaan melalui email yang sudah tertera. Terimakasih</p>
        </div>
    </div>

    <div class="container">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-10">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>Perusahaan</th>
                                                <th>Pekerjaan</th>
                                                <th>Email Perusahaan</th>
                                                <th>Tanggal diterima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accepted as $item)
                                            <tr>
                                                <td>{{ $item->business->name ?? '' }}</td>
                                                <td>{{ $item->job->title ?? '' }}</td>
                                                <td>{{ $item->business->email ?? '' }}</td>
                                                <td>{{ $item->updated_at->format('d F, Y') ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endif

    <div class="container">
        
        <section id="column-selectors">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table table-striped dataex-html5-selectors">
                                        <thead>
                                            <tr>
                                                <th>Nama Pelamar</th>
                                                <th>Perusahaan</th>
                                                <th>Pekerjaan</th>
                                                <th>Tanggal diterima</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $apply)
                                            <tr>
                                                <td>{{ $apply->user->name ?? '' }}</td>
                                                <td>{{ $apply->business->name ?? '' }}</td>
                                                <td>{!! $apply->job->description ?? '' !!}</td>
                                                <td>{{ $apply->updated_at->format('d F, Y') ?? '' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<br><br><br><br><br><br>
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>

    <script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
    
    
@endsection