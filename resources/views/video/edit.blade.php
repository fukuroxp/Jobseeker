<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('video.update', [$data->id]), 'method' => 'post', 'files' => true]) !!}
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Materi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', 'Judul') !!}
                {!! Form::text('name', $data->name, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Deskripsi') !!}
                {!! Form::textarea('description', $data->description, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('file', 'File') !!}
                {!! Form::file('file', null, ['class' => 'form-control-file', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>