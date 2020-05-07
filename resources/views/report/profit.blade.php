@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Laporan Penjualan</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Data list view starts -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-start">
                                <div class="mr-2">
                                    <p class="mb-50 text-bold-600">Laba Bersih</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">Rp</sup>
                                        <span class="text-success">{{ number_format($profit['bersih'], 2, ',' , '.') }}</span>
                                    </h2>
                                </div>
                                <div class="mb-1">
                                    <p class="mb-50 text-bold-600">Laba Kotor</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">Rp</sup>
                                        <span>{{ number_format($profit['kotor'], 2, ',' , '.') }}</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        {{-- <button class="btn btn-outline-primary btn-modal" data-href="{{ route('users.create') }}"><i class='feather icon-plus'></i> Tambah</button> --}}
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Produk</th>
                                            <th>Quantity</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Keuntungan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            <tr>
                                                <td>{{ date('Y-m-d H:i', strtotime($value['created_at'])) }}</td>
                                                <td>{{ $value['product'] ?? '' }}</td>
                                                <td>{{ $value['qty'] ?? '0' }}</td>
                                                <td>Rp {{ $value['purchase_price'] ? number_format($value['purchase_price'], 2, ',' , '.') : '0' }}</td>
                                                <td>Rp {{ $value['sell_price'] ? number_format($value['sell_price'], 2, ',' , '.') : '0' }}</td>
                                                <td>Rp {{ $value['profit'] ? number_format($value['profit'], 2, ',' , '.') : '0' }}</td>
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
    <!-- Data list view end -->
</div>
@endsection

@section('js')
    <script>
        $('.datatable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    </script>
@endsection