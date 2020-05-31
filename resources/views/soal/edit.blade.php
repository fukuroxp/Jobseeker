<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('soal.update', [$data->id]), 'method' => 'put']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Soal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', 'Soal') !!}
                {!! Form::select('name', ['UTS' => 'UTS', 'UAS' => 'UAS'], $data->name, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('size_item', 'Jumlah Butir Soal') !!}
                {!! Form::number('size_item', $data->size_item, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('size_choices', 'Jumlah Butir Pilihan Per Soal') !!}
                {!! Form::number('size_choices', $data->size_choices, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('timer', 'Waktu Pengerjaan (menit)') !!}
                {!! Form::number('timer', $data->timer/60, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('start_at', 'Tgl Mulai') !!}
                {!! Form::text('start_at', $data->start_at, ['class' => 'form-control pickadate', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('due_at', 'Deadline') !!}
                {!! Form::text('due_at', $data->due_at, ['class' => 'form-control pickadate', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
$('.pickadate').pickadate({
    editable: true,
    format: 'yyyy-mm-dd'
});
</script>