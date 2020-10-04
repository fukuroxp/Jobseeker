@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title mb-0">Data Paket Layanan</h2>
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
                    @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('HRD'))
                    <div class="card-header">
                        <button class="btn btn-outline-primary btn-modal" data-href="{{ route('subscriptions.create') }}"><i class='feather icon-plus'></i> Tambah</button>
                    </div>
                    @endif
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                                            <th>Nama Perusahaan</th>
                                            @endif
                                            <th>Paket</th>
                                            <th>Status</th>
                                            @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                                            <th>Tindakan</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            @php
                                                if($value->status == 'waiting'){
                                                    $status = 'MENUNGGU';
                                                    $chip = 'warning';
                                                } else if($value->status == 'approved') {
                                                    if(date('Y-m-d') < date('Y-m-d', strtotime($value->expired_at))) {
                                                        $status = 'AKTIF SAMPAI ' . date('d/m/Y', strtotime($value->expired_at));
                                                        $chip = 'success';
                                                    } else {
                                                        $status = 'KEDALUARSA';
                                                        $chip = 'success';
                                                    }
                                                } else {
                                                    $status = 'DITOLAK';
                                                    $chip = 'dark';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ date('d/m/Y H:i', strtotime($value->created_at)) }}</td>
                                                @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                                                <td>{{ $value->user->business->name }}</td>
                                                @endif
                                                <td>{{ $value->package->name ?? '' }}</td>
                                                <td>
                                                    <div class="chip chip-{{ $chip }}">
                                                        <div class="chip-body">
                                                            <div class="chip-text">{{ $status }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                @if (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))
                                                <td>
                                                    @if($value->status == 'waiting' && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin')))
                                                        <span class="action-approval" style="cursor: pointer;" data-action="approved" data-href="{{ route('subscriptions.action', [$value->id]) }}"><i class="feather icon-check" title="Approve"></i></span>
                                                        <span class="action-approval" style="cursor: pointer;" data-action="rejected" data-href="{{ route('subscriptions.action', [$value->id]) }}"><i class="feather icon-x" title="Reject"></i></span>
                                                    @endif
                                                    -
                                                </td>
                                                @endif
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

    <div class="modal fade action-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>
    <div class="modal fade" id="imagemodal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" id="imagepreview" style="width: 100%; height: 100%;" >
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
    <script>
        $('.datatable').DataTable({
            order: [[0, 'desc']]
        });

        $('.datatable').on('click', '.btn-modal', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.datatable').on('click', '.action-approval', function(e){
            var btn = $(this);
            e.stopPropagation();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan melakukan tindakan pada data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: btn.data('href'),
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            status: btn.data('action')
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message
                                }).then((result) => {
                                    location.reload();
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

        $('.datatable').on('click', '.action-image', function(e) {
            $('#imagepreview').attr('src', $(this).data('href')); // here asign the image to the modal when the user click the enlarge link
            $('#imagemodal').modal('show');
        })
    </script>
@endsection