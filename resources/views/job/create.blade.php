<div class="modal-dialog modal-lg" role="document">
    {!! Form::open(['url' => route('jobs.store'), 'method' => 'post', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Lowongan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if (auth()->user()->hasRole('Admin|Super Admin'))
            <div class="form-group">
                {!! Form::label('title', 'Perusahaan') !!}
                <select name="business_id" class="form-control select2" required>
                    @foreach(\DB::table('businesses')
                            ->get() as $ps)
                      <option value="{{$ps->id}}">{{$ps->name ?? ''}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                {!! Form::label('title', 'Kategori Lowongan') !!}
                <select name="category[]" multiple="multiple" class="form-control select2-multiple" required>
                    @foreach(\App\Category::orderBy('nama', 'ASC')
                            ->get() as $ps)
                      <option value="{{$ps->id}}">{{$ps->nama ?? ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Regional Lowongan (Pilih Kota)') !!}
                <select name="city[]" multiple="multiple" class="form-control select2-multiple" required>
                    @foreach(\App\City::orderBy('title', 'ASC')
                            ->get() as $kt)
                      <option value="{{$kt->id}}">{{$kt->title ?? ''}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Judul') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'required', 'placeholder' => 'Web Developer', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('type', 'Jenis Pekerjaan') !!}
                {!! Form::text('type', null, ['class' => 'form-control', 'required' ,'placeholder' => 'Fulltime', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('study', 'Minimal Study') !!}
                {!! Form::text('study', null, ['class' => 'form-control' , 'required',  'placeholder' => 'S1/S2', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Deskripsi') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('due_at', 'Deadline') !!}
                {!! Form::text('due_at', null, ['class' => 'form-control pickadate', 'required', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('description');
    $('.pickadate').pickadate({
        editable: true,
        format: 'yyyy-mm-dd'
    });
</script>

<script type="text/javascript">
         $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Perusahaan",
            });
            
            $(".select2-multiple").select2({
                placeholder: "Pilih kategori lowongan",
                maximumSelectionLength: 4
            });
    
        });
    </script>