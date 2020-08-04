@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title d-flex justify-content-center mb-0">Nilai Siswa</h2>
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
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table id="table-nilai" class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tugas 1</th>
                                            <th>Tugas 2</th>
                                            <th>Tugas 3</th>
                                            <th>Tugas 4</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                        </tr>
                                    </thead>
                                    {!! Form::open(['url' => route('report.saveNilai'), 'method' => 'post']) !!}
                                        <tbody>
                                            @foreach ($data as $value)
                                                @php
                                                    $nilai = json_decode($value->nilai);
                                                @endphp
                                                <tr>
                                                    <td>{{ $value->nomor_induk ?? '-' }}</td>
                                                    <td>{{ $value->name ?? '' }}</td>
                                                    <td>{{ $value->kelas->name ?? '' }}</td>
                                                    @if (auth()->user()->hasRole('student'))
                                                        <td>{{ $nilai->tugas_1 ?? '0' }}</td>
                                                        <td>{{ $nilai->tugas_2 ?? '0' }}</td>
                                                        <td>{{ $nilai->tugas_3 ?? '0' }}</td>
                                                        <td>{{ $nilai->tugas_4 ?? '0' }}</td>
                                                    @else
                                                        <td>{{ Form::number('tugas_1', $nilai->tugas_1, ['data-id' => $value->id, 'class' => 'form-control w-75']) }}</td>
                                                        <td>{{ Form::number('tugas_2', $nilai->tugas_2, ['data-id' => $value->id, 'class' => 'form-control w-75']) }}</td>
                                                        <td>{{ Form::number('tugas_3', $nilai->tugas_3, ['data-id' => $value->id, 'class' => 'form-control w-75']) }}</td>
                                                        <td>{{ Form::number('tugas_4', $nilai->tugas_4, ['data-id' => $value->id, 'class' => 'form-control w-75']) }}</td>
                                                    @endif
                                                    <td>{{ $nilai->uts ?? '0' }}</td>
                                                    <td>{{ $nilai->uas ?? '0' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    {!! Form::close() !!}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
    <script>
        $('.datatable').DataTable({
            "order": [
                [0, 'desc']
            ]
        });

        @if(!auth()->user()->hasRole('student'))
        $("#table-nilai").on("change", "input", function(){
            var input = $(this)
            var id = input.data('id')
            var index = input.attr('name')
            var nilai = input.val()
            
            $.ajax({
                url: $('#form').attr("action"),
                method: 'POST',
                dataType: 'json',
                data: {
                    'id': id,
                    'index': index,
                    'nilai': nilai
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log(res.message)
                }
            })
        });

        $('#form').submit(function(e) {
            e.preventDefault()
        })
        @endif
    </script>
@endsection