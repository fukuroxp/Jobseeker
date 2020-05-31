<div class="form-group">
    {!! Form::label('nomor_induk', 'NIP') !!}
    {!! Form::text('nomor_induk', ($data) ? $data->nomor_induk : null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('jabatan', 'Jabatan') !!}
    {!! Form::text('jabatan', ($data) ? $data->jabatan : null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('address', 'Alamat') !!}
    {!! Form::textarea('address', ($data) ? $data->address : null, ['class' => 'form-control', 'required']) !!}
</div>