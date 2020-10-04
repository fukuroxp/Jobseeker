<div class="modal-dialog modal-lg" role="document">
    {!! Form::open(['url' => route('articles.store'), 'method' => 'post', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Artikel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('title', 'Judul') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'required', 'placeholder' => '', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('thumbnail', 'Thumbnail') !!}
                {!! Form::file('thumbnail', ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content', 'Konten') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('content');
</script>