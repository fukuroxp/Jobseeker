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
                <div class="col-md">
                    <div class="form-group">
                        {!! Form::label('note', 'Motivation Letter') !!}
                        {!! Form::textarea('note', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                
                <div class="col-md">
                    <fieldset class="form-group">
                        <label for="lampiran">File Lampiran (opsional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="lampiran" name="lampiran">
                            <label class="custom-file-label" for="lampiran">Pilih file</label>
                        </div>
                    </fieldset>
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