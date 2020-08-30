<div class="modal-dialog modal-lg" role="document">
    {!! Form::open(['url' => route('jobs.apply', [$data->id]), 'method' => 'post', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Lamar Pekerjaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card w-100">
                        <a target="_blank" href="{{ asset('uploads/file/'.$data->file) }}">
                            <div class="card-content p-5">
                                <div class="d-flex justify-content-center">
                                    <i class="fa fa-file-pdf fa-4x"></i>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <strong>Download Soal</strong>
                                </div>
                                <div class="d-flex justify-content-center">
                                    @php
                                        $label = (strpos($data->file, '_')) ? explode('_', $data->file)[1] : $data->file;
                                    @endphp
                                    <strong> {{ \Str::limit($label, 50, $end='...') }}</strong>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('note', 'Catatan') !!}
                        {!! Form::textarea('note', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('file', 'File Jawaban Lamaran') !!}
                        {!! Form::file('file', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary btn-apply" data-href="">Lamar</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('note');
</script>