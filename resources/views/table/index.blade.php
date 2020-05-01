@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Meja</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i> Cetak</button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" target="_blank" href="{{ route('tables.print', ['size' => '100']) }}">100x100</a>
                    <a class="dropdown-item" target="_blank" href="{{ route('tables.print', ['size' => '200']) }}">200x200</a>
                    <a class="dropdown-item" target="_blank" href="{{ route('tables.print', ['size' => '300']) }}">300x300</a>
                    <a class="dropdown-item" target="_blank" href="{{ route('tables.print', ['size' => '500']) }}">500x500</a>
                </div>
                <button class="btn-icon btn btn-primary btn-round btn-sm btn-modal" data-href="{{ route('tables.create') }}"><i class="feather icon-settings"></i> Atur</button>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Gradient color start -->
    <section id="backcolor-gradient">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Meja</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @php
                                $colors = ['primary', 'success', 'danger', 'warning', 'info'];
                                $counter = 0;
                            @endphp
                                @if (count($data) > 0)
                                    <div class="d-flex justify-content-start flex-wrap">
                                            @foreach ($data as $key => $value)
                                                <div class="text-center colors-container bg-gradient-{{$colors[$counter]}} rounded text-white width-100 height-100 d-flex align-items-center justify-content-center mr-1 ml-50 my-1 shadow">
                                                    <span class="align-middle">{{ auth()->user()->business->prefixes['table'] ?? '' }}{{$value->name}}</span>
                                                </div>
                                                @php
                                                    if($counter >= (count($colors)-1)) $counter = 0;
                                                    else $counter++;
                                                @endphp
                                            @endforeach
                                    </div>
                                @else
                                    <div class="row d-flex justify-content-center mb-1">
                                        <img src="{{ asset('app-assets/images/pages/graphic-6.png') }}" alt="" width="250" height="250">
                                    </div>
                                    <h3 class="row d-flex justify-content-center">Tidak ada data Meja</h3>
                                    <p class="row d-flex justify-content-center">Data meja akan ditampilkan disini</p>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gradient color end -->

    <div class="modal fade action-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')
    <script>
        $('.btn-modal').click(function() {
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