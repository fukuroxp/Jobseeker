
<div class="col-12">
    <div class="form-group">
        <div class="controls">
            {!! Form::label('nomor_induk', 'NIS') !!}
            {!! Form::text('nomor_induk', ($data) ? $data->nomor_induk : null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <div class="controls">
            {!! Form::label('ttl', 'TTL') !!}
            {!! Form::text('ttl', ($data) ? $data->ttl : null, ['class' => 'form-control', 'required', 'placeholder' => 'Surabaya, 9 September 1999']) !!}
        </div>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <div class="controls">
            {!! Form::label('phone', 'No. HP') !!}
            {!! Form::text('phone', ($data) ? $data->phone : null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>