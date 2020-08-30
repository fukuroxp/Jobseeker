<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Detail Perusahaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-2">
                    <img width="100rem" height="100rem" src="{{ ($data && $data->logo) ? asset('uploads/images/'.$data->logo) : asset('uploads/images/default.png') }}" alt="">
                </div>
                <div class="col-md-10">
                    <h3 class="mb-0">{{ $data->name ?? '' }}</h3>
                    <span class="text-small"><b>Phone:</b> {{ $data->phone ?? '-' }} <b>Email:</b> {{ $data->email ?? '-' }}</span>
                    <span class="text-small">
                        {!! $data->description ?? '' !!}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>