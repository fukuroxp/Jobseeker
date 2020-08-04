@extends('layouts.app2')

@section('content')
<div class="sidebar-left">
    <div class="sidebar">
        <div class="sidebar-content card">
            @if (!auth()->user()->hasRole('student'))
                <div class="chat-fixed-search">
                    <div class="d-flex justify-content-center">
                        <div class="position-relative">
                            <button class="btn btn-primary round action_add">Tambah Video</button>
                        </div>
                    </div>
                </div>
            @endif
            <div id="users-list" class="chat-user-list list-group position-relative">
                <h3 class="primary p-1 mb-0">Timeline Video</h3>
                <ul class="chat-users-list-wrapper media-list">
                    @if (count($data) > 0)
                    @foreach ($data as $value)
                    <li data-v-url="{{ asset('uploads/file/'.$value->file) }}" data-v-id="{{ $value->id }}">
                        <div class="pr-1">
                            <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('assets/images/playbutton.png') }}" height="42" width="42" alt="PlayButton">
                                <i></i>
                            </span>
                        </div>
                        <div class="user-chat-info">
                            <div class="contact-info">
                                <h5 class="font-weight-bold mb-0">{{ $value->name ?? '' }}</h5>
                                <p class="truncate">{{ $value->description ?? '' }}</p>
                            </div>
                            <div class="contact-meta">
                                <span class="float-right">{{ date('Y/m/d', strtotime($value->created_at)) }}</span><br>
                                <span class="action-edit float-right" data-href="{{ route('video.edit', [$value->id]) }}"><i class="feather icon-edit" title="Edit"></i></span>
                                <span class="action-delete float-right" data-href="{{ route('video.destroy', [$value->id]) }}"><i class="feather icon-trash" title="Delete"></i></span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                        <div class="row d-flex justify-content-center mb-1">
                            <img src="{{ asset('app-assets/images/pages/graphic-6.png') }}" alt="" width="150" height="150">
                        </div>
                        <h3 class="row d-flex justify-content-center">Tidak ada video</h3>
                        <p class="row d-flex justify-content-center">Data video akan ditampilkan disini</p>
                    @endif
                </ul>
            </div>
        </div>
        <!--/ Chat Sidebar area -->

    </div>
</div>
<div class="content-right">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="chat-overlay"></div>
            <section class="chat-app-window">
                <div class="start-chat-area">
                    <span class="mb-1 start-chat-icon feather icon-play-circle"></span>
                    <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Mulai Menonton</h4>
                </div>
                <div class="active-chat d-none">
                    <div class="chat_navbar">
                        <header class="chat_header d-flex justify-content-between align-items-center p-1">
                            <div class="vs-con-items d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                    <img src="{{ asset('assets/images/playbutton.png') }}" alt="" height="40" width="40" />
                                    <span class="avatar-status-busy"></span>
                                </div>
                                <h6 class="mb-0">Video</h6>
                            </div>
                        </header>
                    </div>
                    <div class="video-container">
                        
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="modal fade action-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

@endsection

@section('js')
    <script src="{{ asset('app-assets/js/scripts/pages/app-chat.js') }}"></script>

    <script>
        $('.action_add').on('click', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: '{{ route("video.create") }}',
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.action-edit').on("click",function(e){
            e.stopPropagation();
            var t = $('.action-modal');
            $.ajax({
                url: $(this).data('href'),
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        });

        // On Delete
        $('.action-delete').on("click", function(e){
            var btn = $(this);
            e.stopPropagation();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: btn.data('href'),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(res) {
                            if(res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message
                                }).then((result) => {
                                    btn.closest('li').fadeOut();
                                    $('.start-chat-area').removeClass('d-none');
                                    $('.active-chat').addClass('d-none');
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message
                                })
                            }
                        }
                    })
                }
            })
        });

        function markVideoAsWatched(id) {
            $.ajax({
                url: 'video/' + id,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                }
            })
        }
    </script>
@endsection