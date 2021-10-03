@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title mb-0">Data Lamaran</h2>
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
                    @if (auth()->user()->hasRole('Admin|Super Admin'))
                        <div class="card-header">
                            <button class="" style="visibility:hidden;"></button>
                            <a class="btn btn-outline-success pull-right" style="float:right;" target="__blank" href="{{route('excel.pelamar')}}"><i class='feather icon-download'></i> Cetak Excel</a>
                        </div>
                    @endif
                    
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Pelamar</th>
                                            @if (!auth()->user()->hasRole('Jobseeker'))
                                            <th>Data Pelamar</th>
                                            @endif
                                            <th>Perusahaan</th>
                                            <th>Pekerjaan</th>
                                            <th>Status</th>
                                            @if (!auth()->user()->hasRole('Jobseeker'))
                                            <th>Tindakan</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $value)
                                            <tr>
                                                <td>{{ date('d/m/Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ $value->user->profile->nama ?? '' }}</td>
                                                @if (!auth()->user()->hasRole('Jobseeker'))
                                                <td>
                                                    <a target="_blank" href="{{ route('applicants.detail', [$value->id]) }}">Lihat</a>
                                                </td>
                                                @endif
                                                <td>{{ $value->business->name ?? '' }}</td>
                                                <td>{{ $value->job->title ?? '' }}</td>
                                                @php
                                                    $chip = $value->status == 'waiting' ? 'warning' : ($value->status == 'approved' ? 'success' : 'danger');
                                                @endphp
                                                <td>
                                                    <div class="chip chip-{{ $chip }}">
                                                        <div class="chip-body">
                                                            <div class="chip-text">{{ $value->status ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                @if (auth()->user()->hasRole('HRD'))
                                                    <td>
                                                        @if ($value->status == 'waiting')
                                                            <span class="btn-edit badge badge-pill badge-success" style="cursor: pointer;" data-status="" data-href="{{ route('jobs.getApproval', [$value->id, 'approved']) }}"><i class="feather icon-check" title="Terima"> Terima</i></span>
                                                            <span class="btn-edit badge badge-pill badge-danger" style="cursor: pointer;" data-status="" data-href="{{ route('jobs.getApproval', [$value->id, 'rejected']) }}"><i class="feather icon-x" title="Tolak"> Tolak</i></span>
                                                        @endif
                                
                                                    </td>
                                                @else
                                                <td>-</td>
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
    <div class="modal fade child-modal" id="xlarge" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')
    <script>
        $('.datatable').DataTable();

        $('.datatable').on('click', '.btn-edit', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.datatable').on('click', '.btn-action', function(e){
            var btn = $(this);
            e.stopPropagation();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan melakukan tindakan pada data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lakukan!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: btn.data('href'),
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            status: btn.data('status')
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message
                                }).then((result) => {
                                    location.reload()
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