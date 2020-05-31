@extends('layouts.app')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Timeline Materi</h2>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Data list view starts -->
    <section id="data-thumb-view" class="data-thumb-view-header">
        <!-- dataTable starts -->
        <div class="table-responsive">
            <table class="table data-thumb-view">
                <thead>
                    <tr>
                        <th></th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Tgl</th>
                        <th>File</th>
                        @if (!auth()->user()->hasRole('student'))
                            <th>Tindakan</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $value)
                        <tr>
                            <td></td>
                            <td>{{ $value->name ?? '' }}</td>
                            <td>{{ $value->description ?? '' }}</td>
                            <td>{{ date('Y/m/d', strtotime($value->created_at)) }}</td>
                            <td>
                                <div class="chip chip-success">
                                    <div class="chip-body">
                                        <div class="chip-text"><span class="action-show" data-href="{{ route('materi.show', [$value->id]) }}">Download</span></div>
                                    </div>
                                </div>
                            </td>
                            @if (!auth()->user()->hasRole('student'))
                            <td>
                                <span class="action-edit" data-href="{{ route('materi.edit', [$value->id]) }}"><i class="feather icon-edit" title="Edit"></i></span>
                                <span class="action-delete" data-href="{{ route('materi.destroy', [$value->id]) }}"><i class="feather icon-trash" title="Delete"></i></span>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- dataTable ends -->
    </section>
    <!-- Data list view end -->

    <div class="modal fade action-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            "use strict"
            // init thumb view datatable
            var dataThumbView = $(".data-thumb-view").DataTable({
                responsive: false,
                columnDefs: [
                {
                    orderable: true,
                    targets: 0,
                    checkboxes: { selectRow: true }
                }
                ],
                dom:
                '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
                oLanguage: {
                sLengthMenu: "_MENU_",
                sSearch: ""
                },
                aLengthMenu: [[4, 10, 15, 20], [4, 10, 15, 20]],
                select: {
                style: "multi"
                },
                order: [[3, "asc"]],
                bInfo: false,
                pageLength: 20,
                buttons: [
                    @if(!auth()->user()->hasRole('student'))
                    {
                        text: "<i class='feather icon-plus'></i> Tambah",
                        action: function() {
                            $(this).removeClass("btn-secondary")
                            
                            var t = $('.action-modal');
                            $.ajax({
                                url: '{{ route("materi.create") }}',
                                dataType: "html",
                                success: function(e) {
                                    $(t).html(e).modal("show")
                                }
                            })
                        },
                        className: "btn-outline-primary"
                    }
                    @endif
                ],
                initComplete: function(settings, json) {
                $(".dt-buttons .btn").removeClass("btn-secondary")
                }
            })

            dataThumbView.on('draw.dt', function(){
                setTimeout(function(){
                if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                    $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
                }
                }, 50);
            });

            // To append actions dropdown before add new button
            var actionDropdown = $(".actions-dropodown")
            actionDropdown.insertBefore($(".top .actions .dt-buttons"))


            // Scrollbar
            if ($(".data-items").length > 0) {
                new PerfectScrollbar(".data-items", { wheelPropagation: false })
            }

            // Close sidebar
            $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function() {
                $(".add-new-data").removeClass("show")
                $(".overlay-bg").removeClass("show")
                $("#data-name, #data-price").val("")
                $("#data-category, #data-status").prop("selectedIndex", 0)
            })

            // On Edit
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

            // On Stok
            $('.action-show').on("click",function(e){
                e.stopPropagation();
                $.ajax({
                    url: $(this).data('href'),
                    dataType: "json",
                    success: function(data) {
                        window.open('uploads/file/'+data.file,'_blank');
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
                                        btn.closest('td').parent('tr').fadeOut();
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

            // dropzone init
            Dropzone.options.dataListUpload = {
                complete: function(files) {
                var _this = this
                // checks files in class dropzone and remove that files
                $(".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons").on(
                    "click",
                    function() {
                    $(".dropzone")[0].dropzone.files.forEach(function(file) {
                        file.previewElement.remove()
                    })
                    $(".dropzone").removeClass("dz-started")
                    }
                )
                }
            }
            Dropzone.options.dataListUpload.complete()

            // mac chrome checkbox fix
            if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
            }
        })
    </script>
@endsection