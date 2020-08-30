<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Detail Lowongan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-2">
                    <img width="100rem" height="100rem" src="{{ ($data->business && $data->business->logo) ? asset('uploads/images/'.$data->business->logo) : asset('uploads/images/default.png') }}" alt="">
                    <h5 class="mt-1">{{ $data->business->name ?? '' }}</h5>
                </div>
                <div class="col-md-10">
                    <h3 class="mb-0">{{ $data->title ?? '' }}</h3>
                    <span class="text-small"><b>Jenis Pekerjaan:</b> {{ $data->type ?? '-' }} <b>Minimal Study:</b> {{ $data->study ?? '-' }}</span>
                    <span class="text-small">
                        {!! $data->description ?? '' !!}
                    </span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (auth()->user())
                <button data-dismiss="modal" class="btn btn-primary btn-apply" data-href="{{ route('jobs.getApply', [$data->id]) }}">Lamar</button>
            @else
                <a class="btn btn-primary" href="{{ route('login') }}">Login Untuk Melamar</a>
            @endif
        </div>
    </div>
</div>
<script>
    $('.btn-apply').on('click', function(e){
        var t = $('.child-modal');
        $.ajax({
            url: $(this).data('href'),
            dataType: "html",
            success: function(e) {
                $(t).html(e).modal("show")
            }
        })
    })
</script>