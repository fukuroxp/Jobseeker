<div class="form-group">
    {!! Form::label('nomor_induk', 'NIS') !!}
    {!! Form::text('nomor_induk', ($data) ? $data->nomor_induk : null, ['class' => 'form-control', 'required', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
</div>
<div class="form-group">
    {!! Form::label('kelas_id', 'Kelas') !!}
    {!! Form::select('kelas_id', $kelas, ($data) ? $data->kelas_id : null, ['class' => 'form-control', 'required', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
</div>
<div class="form-group">
    {!! Form::label('ttl', 'TTL') !!}
    {!! Form::text('ttl', ($data) ? $data->ttl : null, ['class' => 'form-control', 'required', 'placeholder' => 'Surabaya, 9 September 1999', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
</div>
<div class="form-group">
    {!! Form::label('phone', 'No. HP') !!}
    {!! Form::text('phone', ($data) ? $data->phone : null, ['class' => 'form-control', 'required', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
</div>