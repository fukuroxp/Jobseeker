<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('users.update', [$data->id]), 'method' => 'put']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', 'Nama') !!}
                {!! Form::text('name', $data->name, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', $data->email, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>