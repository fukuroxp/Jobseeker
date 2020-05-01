<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('products.updateStock', [$data->id]), 'method' => 'put']) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Atur Stok</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="form-group col">
                    {!! Form::text('name', $data->name, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="form-group col">
                    {!! Form::number('qty', $data->qty, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>