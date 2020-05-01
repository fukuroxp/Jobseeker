<div class="modal-dialog modal-xl" role="document">
    {!! Form::open(['url' => route('products.store'), 'method' => 'post', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel16">Tambah Produk</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="form-group col-6">
                    {!! Form::label('name', 'Nama') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group col-3">
                    {!! Form::label('category_id', 'Kategori') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group col-3">
                    {!! Form::label('sku', 'SKU') !!}
                    {!! Form::text('sku', $sku ?? null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    {!! Form::label('description', 'Deskripsi') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-3">
                    {!! Form::label('purchase_price', 'Harga Beli') !!}
                    {!! Form::number('purchase_price', 0, ['class' => 'form-control', 'required', 'id' => 'purchase_price']) !!}
                </div>
                <div class="form-group col-3">
                    {!! Form::label('margin', 'Margin(%)') !!}
                    {!! Form::number('margin', 25, ['class' => 'form-control', 'required', 'id' => 'margin']) !!}
                </div>
                <div class="form-group col-3">
                    {!! Form::label('sell_price', 'Harga Jual') !!}
                    {!! Form::number('sell_price', 0, ['class' => 'form-control', 'required', 'id' => 'sell_price']) !!}
                </div>
                <div class="form-group col-3">
                    {!! Form::label('qty', 'Stok Awal') !!}
                    {!! Form::number('qty', 0, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    {!! Form::label('image', 'Gambar') !!}
                    <div class="custom-file">
                        {!! Form::file('image', null, ['class' => 'custom-file-input', 'required', 'accept' => "image/*"]) !!}
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    $('#purchase_price').change(function() {
        var res = parseInt($(this).val()) + (parseInt($(this).val()) * (parseInt($('#margin').val())/100))
        $('#sell_price').val(res)
    })

    $('#margin').change(function() {
        var res = parseInt($('#purchase_price').val()) + (parseInt($('#purchase_price').val()) * (parseInt($(this).val())/100))
        $('#sell_price').val(res)
    })

    $('#sell_price').change(function() {
        var res = ((parseInt($(this).val()) - parseInt($('#purchase_price').val())) / parseInt($('#purchase_price').val())) * 100
        $('#margin').val(res)
    })
</script>