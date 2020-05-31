<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('kelas.store'), 'method' => 'post']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', 'Nama') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'X MM 1']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('jurusan', 'Jurusan') !!}
                {!! Form::text('jurusan', null, ['class' => 'form-control', 'required', 'placeholder' => 'Multimedia']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>