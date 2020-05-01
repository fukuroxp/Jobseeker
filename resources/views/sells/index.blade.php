@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Daftar Penjualan</h2>
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
                                            <th>No Ref</th>
                                            <th>Kasir</th>
                                            <th>Pelanggan</th>
                                            <th>Meja</th>
                                            <th>Pembayaran</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            <tr>
                                                <td>{{ date('d/m/Y H:i', strtotime($value->created_at)) }}</td>
                                                <td>{{ $value->ref_no ?? '' }}</td>
                                                <td>{{ $value->employee->name ?? '' }}</td>
                                                <td>{{ $value->customer->name ?? '' }}</td>
                                                <td>
                                                    <span class="badge badge badge-info badge-pill">{{ $value->table->name ?? '' }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        if($value->payment_status == 'paid'){
                                                            $chip = 'success';
                                                            $status = 'Selesai';
                                                        } else {
                                                            $chip = 'warning';
                                                            $status = 'Belum Bayar';
                                                        }
                                                    @endphp
                                                    <div class="chip chip-{{$chip}}">
                                                        <div class="chip-body">
                                                            <div class="chip-text">{{ $status ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="chip chip-primary">
                                                        <div class="chip-body">
                                                            <div class="chip-text">Rp {{ $value->total ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- <td>
                                                    @if (auth()->user()->id != $value->id)
                                                        <span class="btn-modal" style="cursor: pointer;" data-href="{{ route('users.edit', [$value->id]) }}"><i class="feather icon-edit" title="Edit"></i></span>
                                                        <span class="action-delete" style="cursor: pointer;" data-href="{{ route('users.destroy', [$value->id]) }}"><i class="feather icon-trash" title="Delete"></i></span>
                                                    @endif
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th colspan="6"></th>
                                        <td colspan="1">{{ 'Rp' }}</td>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Data list view end -->

    <div class="modal fade action-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')
    <script>
        $('.datatable').DataTable({
            "order": [[ 0, "desc" ]]
        });

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

        $('.action-delete').on("click", function(e){
            var btn = $(this);
            e.stopPropagation();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: btn.data('href'),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message
                                }).then((result) => {
                                    btn.closest('td').parent('tr').fadeOut();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message
                                })
                            }
                        }
                    })
                }
            })
        });
    </script>
@endsection