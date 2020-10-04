<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('subscriptions.store'), 'method' => 'post', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Paket Layanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('package_id', 'Paket') !!}
                {!! Form::select('package_id', $data, null, ['class' => 'name form-control', 'required', 'placeholder' => 'Pilih Paket', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    $('.name').on('change', function() {
        let id = this.value
        if(id) {
            $.ajax({
                url: 'packages/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(res) {
                    if(res.status) {
                        $('.package').html(res.data.name)
                        $('.duration').html(res.data.duration + ' hari')
                        $('.description').html(res.data.description)
                    } else {
                        $('.package').html('-')
                        $('.duration').html('-')
                        $('.description').html('-')
                    }
                }
            })
        } else {
            $('.package').html('-')
            $('.duration').html('-')
            $('.description').html('-')       
        }
    });
</script>