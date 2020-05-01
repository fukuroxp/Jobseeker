<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('tables.store'), 'method' => 'post']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Atur Meja</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('count', 'Jumlah') !!}
                {!! Form::text('count', null, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('type', 'Tipe') !!}
                {!! Form::select('type', ['numerik' => 'Numerik (0-9)', 'abjad' => 'Abjad (A-Z)'], null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>