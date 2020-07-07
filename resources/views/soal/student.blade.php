@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title d-flex justify-content-center mb-0">Ujian {{ $data->name ?? '' }}</h2>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <h4><span id="countdown" class="timer"></span></h4>
        </div>
    </div>
</div>
<div class="content-body">
    @if ($data)
    <section id="info" class="@if($data->exam_state == 'start') d-none @endif">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Soal</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <strong>Waktu Pengerjaan:</strong> {{ $data->timer_ori/60 }} menit <br>
                                    <strong>Jumlah Soal:</strong> {{ $data->size_item }} butir <br>
                                    <strong>Tgl Mulai:</strong> {{ strftime("%A, %d %B %Y", strtotime($data->start_at)) }} <br>
                                    <strong>Deadline:</strong> {{ strftime("%A, %d %B %Y", strtotime($data->due_at)) }} <br>
                                </div>
                                <div class="col-sm-6">
                                    @if ($data->exam_state == 'done')
                                        <i class="fa fa-check-circle fa-5x text-success"></i>
                                    @else
                                        @if (!$data->is_permitted)
                                        <button type="button" class="btn btn-lg btn-warning text-white" disabled>Nilai Tidak Memenuhi</button>
                                        @else
                                            @if ($data->start_at <= date('Y-m-d') && $data->due_at >= date('Y-m-d'))
                                                <button type="button" class="btn btn-lg btn-primary btn-start" data-href="{{ route('soal.examStart', [$data->id]) }}">Mulai Mengerjakan</button>
                                            @elseif($data->start_at > date('Y-m-d'))
                                                <button type="button" class="btn btn-lg btn-warning text-white" disabled>Belum Dimulai</button>
                                            @elseif($data->due_at < date('Y-m-d'))
                                                <button type="button" class="btn btn-lg btn-danger" disabled>Ujian Terlewatkan</button>
                                            @else
                                                <button type="button" class="btn btn-lg btn-primary" disabled>Mulai Mengerjakan</button>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Data list view starts -->
    <section id="number-tabs" class="@if($data->exam_state != 'start') d-none @endif">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Soal</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! Form::open(['url' => route('soal.storeAnswer'), 'id' => 'form', 'method' => 'post', 'class' => 'number-tab-steps wizard-circle']) !!}
                                @foreach ($data->soal_item as $i => $value)
                                    <h6>{{ $value->nomor }}</h6>
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        {!! Form::text('old['.$value->id.'][soal]', $value->question, ['id' => 'item_'.$i, 'class' => 'form-control', 'style' => 'background-color:transparent', 'disabled']) !!}
                                        <div class="form-control-position">{{ $value->nomor }}.</div>
                                        {!! Form::label('item_'.$i, 'Soal') !!}
                                        @php
                                            $old_choices = json_decode($value->choices);
                                            $alphas = range('A', 'Z');
                                        @endphp
                                        @foreach($old_choices as $j => $item)
                                        @php
                                            $saved_answer = \App\ExamAnswer::where([
                                                'user_id' => auth()->user()->id,
                                                'soal_item_id' => $value->id,
                                                'soal_id' => $data->id
                                            ])->first();
                                        @endphp
                                        <div class="input-group mt-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ $item->alpha ?? '' }}.</span>
                                            </div>
                                            {!! Form::text('old['.$value->id.'][choices]['.$j.'][choice]', $item->choice, ['class' => 'form-control pl-1', 'style' => 'background-color:transparent', 'disabled', 'placeholder' => 'Jawaban']) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <div class="vs-radio-con">
                                                        {!! Form::radio('data['.$i.']', $item->alpha, ($saved_answer) ? ($saved_answer->answer == $item->alpha ? true : false) : false, ['id' => 'data_'.$i, 'data-id' => $value->id, 'data-soal_id' => $value->soal_id, 'required']) !!}
                                                        <span class="vs-radio vs-radio-sm">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </fieldset>
                                @endforeach
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <section id="empty">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Soal</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center mb-1 mt-3">
                                <img src="{{ asset('app-assets/images/pages/rocket.png') }}" alt="" width="250" height="250">
                            </div>
                            <h3 class="row d-flex justify-content-center">Tidak ada ujian</h3>
                            <p class="row d-flex justify-content-center">Belum ada ujian yang diberikan!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Data list view end -->

    <div class="modal fade action-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')
    <script>
        @if($exist_exam)
            var exam_id = {{ $exist_exam->id }}
        @else
            var exam_id = undefined
        @endif

        $(".number-tab-steps").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: 'Submit'
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                var soal_id = $('#data_'+currentIndex).data('soal_id')
                var soal_item_id = $('#data_'+currentIndex).data('id')
                var answer = $('#data_'+currentIndex+':checked').val()
                $.ajax({
                    url: $('#form').attr("action"),
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        'id': soal_item_id,
                        'soal_id': soal_id,
                        'answer': answer
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        console.log(res.message)
                    }
                })
                return true;
            },
            onFinished: function (event, currentIndex) {
                var soal_id = $('#data_'+currentIndex).data('soal_id')
                var soal_item_id = $('#data_'+currentIndex).data('id')
                var answer = $('#data_'+currentIndex+':checked').val()
                $.ajax({
                    url: $('#form').attr("action"),
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        'id': soal_item_id,
                        'soal_id': soal_id,
                        'answer': answer
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        console.log(res.message)
                        Swal.fire({
                            title: 'Anda yakin?',
                            text: "Anda akan menyelesaikan ujian ini!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Selesaikan!'
                        }).then((result) => {
                            if (result.value) {
                                $.ajax({
                                    url: '{{ route("soal.examFinish") }}',
                                    method: 'POST',
                                    dataType: 'json',
                                    data: {
                                        'id': exam_id
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
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
                    }
                })
            }
        });

        $('.btn-start').click(function(e) {
            var btn = $(this);
            Swal.fire({
                    title: 'Anda yakin?',
                    text: "Anda akan memulai ujian ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Mulai!'
                }).then((result) => {
                    if (result.value) {
                        $('#number-tabs').fadeIn(1000)
                        $('#number-tabs').removeClass('d-none')
                        $('#info').fadeOut(100)
                        $.ajax({
                            url: btn.data('href'),
                            method: 'POST',
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                if(res.status) {
                                    exam_id = res.exam_id
                                    startTimer()
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
        })

        @if($data) 
            @if($data->exam_state == 'start') 
                startTimer()
            @endif

            var upgradeTime = {{ $data->timer }};
            var seconds = upgradeTime;
            function timer() {
                var days        = Math.floor(seconds/24/60/60);
                var hoursLeft   = Math.floor((seconds) - (days*86400));
                var hours       = Math.floor(hoursLeft/3600);
                var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
                var minutes     = Math.floor(minutesLeft/60);
                var remainingSeconds = seconds % 60;
                function pad(n) {
                    return (n < 10 ? "0" + n : n);
                }
                document.getElementById('countdown').innerHTML = pad(days) + ":" + pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
                if (seconds == 0) {
                    clearInterval(countdownTimer);
                    document.getElementById('countdown').innerHTML = "Waktu Habis";
                    Swal.fire({
                        title: 'Waktu habis',
                        text: "Waktu anda habis!",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Kirim Ujian'
                    }).then((result) => {
                        $('#form').trigger('submit');
                    })
                } else {
                    seconds--;
                }
            }

            function startTimer() {
                var countdownTimer = setInterval('timer()', 1000);
            }
        @endif
        
    </script>
@endsection