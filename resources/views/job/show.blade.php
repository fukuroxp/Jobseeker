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
                    <hr>
                    <ul>
                        <span class="text-medium" style="font-size: 15px; line-height: 1.3;"><li><b>Jenis Pekerjaan:</b> {{ $data->type ?? '-' }} <br></li> <li><b>Minimal Study:</b> {{ $data->study ?? '-' }}</li> <li><b>Deadline:</b> {{ date('d-m-Y', strtotime($data->due_at)) ?? '-' }}</li></span>
                        <li> 
                            <hr>
                            <span class="text-medium" style="font-size: 15.5px; line-height: 1.1;">
                                {!! $data->description ?? '' !!}
                            </span>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (auth()->user())
                @if(auth()->user()->hasRole('Jobseeker'))
                    @if(App\JobApplicant::where('user_id', auth()->user()->id)->where('business_id', $data->business_id)->count() < 4)
                        <button data-dismiss="modal" class="btn btn-primary btn-apply" data-href="{{ route('jobs.getApply', [$data->id]) }}">Lamar</button>
                    @else
                        <button class="btn btn-warning" data-href="#">Maaf! Lamaran anda untuk Perusahaan {{$data->business->name}}, telah dibatasi</button>
                    @endif
                @endif
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