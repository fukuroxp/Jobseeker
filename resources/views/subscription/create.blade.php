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
            <div class="form-group">
                {!! Form::label('image', 'Bukti Pembayaran') !!}
                {!! Form::file('image', ['class' => 'form-control']) !!}
            </div>
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Perhatian!</h4>
                <p class="mb-0"><strong>HARAP TRANSFER</strong> ke rekening <strong>BCA</strong> berikut ini.</p>
                <p class="mb-0"><strong>A\N:</strong> Putri Indarbensyah</p>
                <p class="mb-0"><strong>Norek:</strong> 11161717111</p>
                <hr>
                <p>Saat ini anda memilih:</p>
                <p class="mb-0"><strong>Paket:</strong> <span class="package">-</span></p>
                <p class="mb-0"><strong>Harga:</strong> <span class="price">-</span></p>
                <p class="mb-0"><strong>Durasi:</strong> <span class="duration">-</span></p>
                <p class="mb-0"><strong>Deskripsi:</strong> <span class="description">-</span></p>
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
                        $('.price').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(res.data.price))
                        $('.duration').html(res.data.duration + ' hari')
                        $('.description').html(res.data.description)
                    } else {
                        $('.package').html('-')
                        $('.price').html('-')
                        $('.duration').html('-')
                        $('.description').html('-')
                    }
                }
            })
        } else {
            $('.package').html('-')
            $('.price').html('-')
            $('.duration').html('-')
            $('.description').html('-')       
        }
    });
</script>