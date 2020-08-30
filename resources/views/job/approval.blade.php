<div class="modal-dialog modal-lg" role="document">
    {!! Form::open(['url' => route('jobs.action', [$data->id]), 'method' => 'post', 'files' => true]) !!}
    {!! Form::hidden('status', $approval) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">{{ $approval == 'approved' ? 'Approve' : 'Reject' }} {{ $data->user->name ?? '' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('title', 'Judul') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('note', 'Catatan') !!}
                {!! Form::textarea('note', null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-apply" data-href="">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('note');
</script>