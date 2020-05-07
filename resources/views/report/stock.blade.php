@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Laporan Stok</h2>
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
                                            <th>REF NO</th>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            <tr>
                                                <td>{{ date('Y-m-d H:i', strtotime($value->created_at)) }}</td>
                                                <td>{{ $value->ref_no ?? '' }}</td>
                                                <td>{{ $value->product->name ?? '' }}</td>
                                                <td>{{ $value->type == 'debit' ? '- ' : '' }}Rp {{ $value->amount ? number_format($value->amount, 2, ',' , '.') : '0' }}</td>
                                                <td>{{ $value->description ?? '' }}</td>
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
            "order": [[ 0, "desc" ], [1, "desc"]]
        });
    </script>
@endsection