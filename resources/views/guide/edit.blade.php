<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('guides.update', [$data->id]), 'method' => 'put', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Panduan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('for', 'Kategori') !!}
                {!! Form::select('for', $for, $data->for, ['placeholder' => 'Pilih', 'class' => 'form-control select2']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Judul') !!}
                {!! Form::text('title', $data->title ?? '', ['class' => 'form-control', 'required', 'placeholder' => 'Basic', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('file', 'File Panduan') !!}
                {!! Form::file('file', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>