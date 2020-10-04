<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('packages.store'), 'method' => 'post']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Paket Layanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', 'Paket') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Basic', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('duration', 'Durasi (hari)') !!}
                {!! Form::number('duration', null, ['class' => 'form-control', 'required', 'placeholder' => '30', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Deskripsi') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('description');
</script>