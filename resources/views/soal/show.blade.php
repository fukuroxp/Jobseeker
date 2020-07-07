@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title d-flex justify-content-center mb-0">Data Soal {{ $data->name ?? '' }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Data list view starts -->
    @php
        $alphas = range('A', 'Z');
    @endphp
    {!! Form::open(['url' => route('soal.storeItem', [$data->id]), 'method' => 'post']) !!}
    <div class="card collapse-icon accordion-icon-rotate">
        <div class="card-header">
            <h4 class="card-title">Butir Soal</h4>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionExample" data-toggle-hover="true">
                @for ($i = 0; $i < $data->size_item; $i++)
                    @php
                        $old_item = \App\SoalItem::where('nomor', $i+1)
                                                ->where('soal_id', $data->id)
                                                ->first();
                    @endphp
                    @if ($old_item)
                    <div class="collapse-margin">
                        {!! Form::hidden('old['.$old_item->id.'][nomor]', $old_item->nomor) !!}
                        <div class="card-header collapsed" id="heading_{{ $i }}" data-toggle="collapse" role="button" data-target="#collapse_{{ $i }}" aria-expanded="false" aria-controls="collapseOne">
                            <div class="lead collapse-title" style="width: 95%">
                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                    {!! Form::text('old['.$old_item->id.'][soal]', $old_item->question, ['id' => 'item_'.$i, 'class' => 'form-control', 'placeholder' => 'Tulis Pertanyaan', 'required']) !!}
                                    <div class="form-control-position">{{ $old_item->nomor }}.</div>
                                    {!! Form::label('item_'.$i, 'Tulis Pertanyaan') !!}
                                </fieldset>
                            </div>
                        </div>
                        <div id="collapse_{{ $i }}" class="collapse" aria-labelledby="heading_{{ $i }}" data-parent="#accordionExample" style="">
                            <div class="card-body">
                                @php
                                    $old_choices = json_decode($old_item->choices, TRUE)
                                @endphp
                                @for ($j = 0; $j < $data->size_choices; $j++)
                                <fieldset class="mb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ array_key_exists($j, $old_choices) ? $old_choices[$j]['alpha'] : $alphas[$j] }}.</span>
                                        </div>
                                        {!! Form::hidden('old['.$old_item->id.'][choices]['.$j.'][alpha]', array_key_exists($j, $old_choices) ? $old_choices[$j]['alpha'] : $alphas[$j]) !!}
                                        {!! Form::text('old['.$old_item->id.'][choices]['.$j.'][choice]', array_key_exists($j, $old_choices) ? $old_choices[$j]['choice'] : null, ['class' => 'form-control', 'placeholder' => 'Tulis Pilihan dan Centang Apabila Kunci Jawaban', 'required']) !!}
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <div class="vs-radio-con">
                                                    {!! Form::radio('old['.$old_item->id.'][kj]', $alphas[$j], $alphas[$j] == $old_item->kj ? true : false, ['required']) !!}
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </fieldset>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="collapse-margin">
                        {!! Form::hidden('item['.$i.'][nomor]', $i+1) !!}
                        <div class="card-header collapsed" id="heading_{{ $i }}" data-toggle="collapse" role="button" data-target="#collapse_{{ $i }}" aria-expanded="false" aria-controls="collapseOne">
                            <div class="lead collapse-title" style="width: 95%">
                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                    {!! Form::text('item['.$i.'][soal]', null, ['id' => 'item_'.$i, 'class' => 'form-control', 'placeholder' => 'Tulis Pertanyaan', 'required']) !!}
                                    <div class="form-control-position">{{$i+1}}.</div>
                                    {!! Form::label('item_'.$i, 'Tulis Pertanyaan') !!}
                                </fieldset>
                            </div>
                        </div>
                        <div id="collapse_{{ $i }}" class="collapse" aria-labelledby="heading_{{ $i }}" data-parent="#accordionExample" style="">
                            <div class="card-body">
                                @for ($j = 0; $j < $data->size_choices; $j++)
                                <fieldset class="mb-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ $alphas[$j] }}.</span>
                                        </div>
                                        {!! Form::hidden('item['.$i.'][choices]['.$j.'][alpha]', $alphas[$j]) !!}
                                        {!! Form::text('item['.$i.'][choices]['.$j.'][choice]', null, ['class' => 'form-control', 'placeholder' => 'Tulis Pilihan dan Centang Apabila Kunci Jawaban', 'required']) !!}
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <div class="vs-radio-con">
                                                    {!! Form::radio('item['.$i.'][kj]', $alphas[$j], false, ['required']) !!}
                                                    <span class="vs-radio vs-radio-sm">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </fieldset>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary float-right">Simpan</button>
    {!! Form::close() !!}
    <!-- Data list view end -->

    <div class="modal fade action-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')

@endsection