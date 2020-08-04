@extends('layouts.app2')

@section('content')
<div class="sidebar-left">
    <div class="sidebar">
        <div class="sidebar-content todo-sidebar d-flex">
            <span class="sidebar-close-icon">
                <i class="feather icon-x"></i>
            </span>
            <div class="todo-app-menu">
                @if (!auth()->user()->hasRole('student'))
                <div class="form-group text-center add-task">
                    <button type="button" class="btn btn-primary btn-block my-1 action_add">Tambah Tugas</button>
                </div>
                @endif
                <div class="sidebar-menu-list">
                    <h5 class="mt-2 mb-1 pt-25">Labels</h5>
                    <div class="list-group list-group-labels font-medium-1">
                        <a href="#" class="list-group-item list-group-item-action border-0 d-flex align-items-center"><span class="bullet bullet-primary mr-1"></span> Tugas 1</a>
                        <a href="#" class="list-group-item list-group-item-action border-0 d-flex align-items-center"><span class="bullet bullet-warning mr-1"></span> Tugas 2</a>
                        <a href="#" class="list-group-item list-group-item-action border-0 d-flex align-items-center"><span class="bullet bullet-success mr-1"></span> Tugas 3</a>
                        <a href="#" class="list-group-item list-group-item-action border-0 d-flex align-items-center"><span class="bullet bullet-danger mr-1"></span> Tugas 4</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-right">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="app-content-overlay"></div>
            <div class="todo-app-area">
                <div class="todo-app-list-wrapper">
                    <div class="todo-app-list">
                        <div class="app-fixed-search">
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu"></i></div>
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <input type="text" class="form-control" id="todo-search" placeholder="Cari...">
                                <div class="form-control-position">
                                    <i class="feather icon-search"></i>
                                </div>
                            </fieldset>
                        </div>
                        <div class="todo-task-list list-group">
                            @if (count($data) > 0)
                            <ul class="todo-task-list-wrapper media-list">
                                @foreach ($data as $value)
                                @php
                                    $is_turned_in = false;
                                    if($value->task_user) {
                                        if($value->task_user->is_turned_in) {
                                            $is_turned_in = true;
                                        }
                                    }
                                @endphp
                                <li class="todo-item @if($is_turned_in) completed @endif" data-href="{{ (auth()->user()->hasRole('student')) ? route('task.show', [$value->id]) : route('task.edit', [$value->id]) }}">
                                    <div class="todo-title-wrapper d-flex justify-content-between mb-50">
                                        <div class="todo-title-area d-flex align-items-center">
                                            <div class="title-wrapper d-flex">
                                                <div class="vs-checkbox-con">
                                                    <input type="checkbox" {{ $is_turned_in ? 'checked' : '' }}>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <h6 class="todo-title mt-50 mx-50">{{ $value->name ?? '' }}</h6>
                                            </div>
                                            <div class="chip-wrapper">
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="{{ $value->label ?? '' }}"><span class="bullet bullet-primary bullet-xs"></span> {{ $value->label ?? '' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($value->due_at)
                                                <div class="chip-wrapper">
                                                    <div class="chip mb-0">
                                                        <div class="chip-body">
                                                            <span class="chip-text"><span class="fa text-danger fa-xs fa-exclamation-circle"></span> Deadline {{ date('d/m/Y', strtotime($value->due_at)) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($is_turned_in)
                                            <div class="chip-wrapper">
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text"><span class="fa text-success fa-xs fa-check"></span> Selesai</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @if (!auth()->user()->hasRole('student'))
                                        <div class="float-right">
                                            <span class="action-show" data-href="{{ route('task.show', [$value->id]) }}"><i class="fa fa-scroll" title="Lihat Pekerjaan Siswa"></i></span>
                                            <span class="action-delete" data-href="{{ route('task.destroy', [$value->id]) }}"><i class="feather icon-trash" title="Hapus"></i></span>
                                        </div>
                                        @endif
                                    </div>
                                    <p class="todo-desc truncate mb-0">{{ $value->description ?? '' }}</p>
                                </li>
                                @endforeach
                            </ul>
                            @else
                                <div class="todo-item">
                                    <div class="row d-flex justify-content-center mb-1 mt-3">
                                        <img src="{{ asset('app-assets/images/pages/rocket.png') }}" alt="" width="150" height="150">
                                    </div>
                                    <h3 class="row d-flex justify-content-center">Tidak ada tugas</h3>
                                    <p class="row d-flex justify-content-center">Yeey! Tugasmu sudah selesai semua!</p>
                                </div>
                            @endif
                            <div class="no-results">
                                <div class="row d-flex justify-content-center mb-1">
                                    <img src="{{ asset('app-assets/images/pages/graphic-6.png') }}" alt="" width="250" height="250">
                                </div>
                                <h3 class="row d-flex justify-content-center">Tidak ada tugas</h3>
                                <p class="row d-flex justify-content-center">Keyword tugas tidak ditemukan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade action-modal" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true"></div>

@endsection

@section('js')
    <script>
        $('.action_add').on('click', function(e){
            var t = $('.action-modal');
            $.ajax({
                url: '{{ route("task.create") }}',
                dataType: "html",
                success: function(e) {
                    $(t).html(e).modal("show")
                }
            })
        })

        $('.action-show').on('click', function(e){
            e.stopPropagation();
            window.open($(this).data('href'));
        })

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
                                    $(btn).closest('.todo-item').remove();
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
    </script>

    <script>
        $(function() {
            "use strict";

            var $curr_title, $curr_desc, $curr_info, $curr_fav, $curr_chipVal;

            // --------------------------------------------
            // Sidebar menu scrollbar
            // --------------------------------------------
            if($('.todo-application .sidebar-menu-list').length > 0){
                var content = new PerfectScrollbar('.sidebar-menu-list',{
                    theme: "light"
                });
            }

            // --------------------------------------------
            // Todo task list scrollbar
            // --------------------------------------------
            if($('.todo-application .todo-task-list').length > 0){
                var sidebar_todo = new PerfectScrollbar('.todo-task-list',{
                    theme: "light"
                });
            }

            // --------------------------------------------
            // Info star click
            // --------------------------------------------
            $(document).on("click", ".todo-application .todo-item-info i", function(e) {
                $(this).parent('.todo-item-info').toggleClass("success");
                e.stopPropagation();
            });


            // --------------------------------------------
            // Favorite star click
            // --------------------------------------------
            $(document).on("click", ".todo-application .todo-item-favorite i", function(e) {
                $(this).parent('.todo-item-favorite').toggleClass("warning");
                e.stopPropagation();
            });

            // --------------------------------------------
            // Main menu toggle should hide app menu
            // --------------------------------------------
            $('.menu-toggle').on('click',function(e){
                $('.app-content .sidebar-left').removeClass('show');
                $('.app-content .app-content-overlay').removeClass('show');
            });

            // --------------------------------------------
            // On sidebar close click
            // --------------------------------------------
            $(".todo-application .sidebar-close-icon").on('click',function(){
                $('.sidebar-left').removeClass('show');
                $('.app-content-overlay').removeClass('show');
            });

            // --------------------------------------------
            // Todo sidebar toggle
            // --------------------------------------------
            $('.sidebar-toggle').on('click',function(e){
                e.stopPropagation();
                $('.app-content .sidebar-left').toggleClass('show');
                $('.app-content .app-content-overlay').addClass('show');
            });
            $('.app-content .app-content-overlay').on('click',function(e){
                $('.app-content .sidebar-left').removeClass('show');
                $('.app-content .app-content-overlay').removeClass('show');
            });

            // --------------------------------------------
            // Add class active on click of sidebar filters list
            // --------------------------------------------
            $(".todo-application .list-group-filters a").on('click', function(){
                if($('.todo-application .list-group-filters a').hasClass('active')){
                    $('.todo-application .list-group-filters a').removeClass('active');
                }
                $(this).addClass("active");
            });

            // --------------------------------------------
            // For chat sidebar on small screen
            // --------------------------------------------
            if ($(window).width() > 992) {
                if($('.todo-application .app-content-overlay').hasClass('show')){
                    $('.todo-application .app-content-overlay').removeClass('show');
                }
            }

            // --------------------------------------------
            // On add new item, clear modal popup fields
            // --------------------------------------------
            $(".add-task button").on('click', function(e){
                $('.modal .new-todo-item-title').val("");
                $('.modal .new-todo-item-desc').val("");
                $('.modal .dropdown-menu input').prop("checked", false);
                if($('.modal .todo-item-info').hasClass('success')){$('.modal .todo-item-info').removeClass('success')}
                if($('.modal .todo-item-favorite').hasClass('warning')){$('.modal .todo-item-favorite').removeClass('warning')}
            });


            // --------------------------------------------
            // Add New ToDo List Item
            // --------------------------------------------


            // To add new todo list item
            $(".add-todo-item").on('click', function(e){
                e.preventDefault();
                var todoInfo = "",
                todoFav = "",
                todoChip = "";

                var todoTitle = $(".new-todo-item-title").val();
                var todoDesc = $(".new-todo-item-desc").val();
                if($(".modal.show .todo-item-info").hasClass('success')){
                    todoInfo = " success";
                }
                if($(".modal.show .todo-item-favorite").hasClass('warning')){
                    todoFav = " warning";
                }

                // Chip calculation loop
                var selected  = $('.modal .dropdown-menu input:checked');

                selected.each(function(){
                    todoChip += '<div class="chip mb-0">' +
                        '<div class="chip-body">' +
                        '<span class="chip-text" data-value="'+$(this).data('value')+'"><span class="bullet bullet-'+$(this).data('color')+' bullet-xs"></span> '+$(this).data('value')+'</span>' +
                        '</div>' +
                    '</div>';
                });
                // HTML Output
                if(todoTitle != ""){
                    $(".todo-task-list-wrapper").append('<li class="todo-item" style="animation-delay: 0s;"  data-toggle="modal" data-target="#editTaskModal">' +
                        '<div class="todo-title-wrapper d-flex justify-content-between mb-50">' +
                        '<div class="todo-title-area d-flex align-items-center">' +
                            '<div class="title-wrapper d-flex">'+
                            '<div class="vs-checkbox-con">' +
                                '<input type="checkbox" >' +
                                '<span class="vs-checkbox vs-checkbox-sm">' +
                                    '<span class="vs-checkbox--check">' +
                                    '<i class="vs-icon feather icon-check"></i>' +
                                    '</span>' +
                                '</span>' +
                            '</div>' +
                            '<h6 class="todo-title mt-50 mx-50">'+ todoTitle +'</h6>' +
                            '</div>' +
                            '<div class="chip-wrapper">' + todoChip + '</div>' +
                        '</div>' +
                        '<div class="float-right todo-item-action d-flex">' +
                            '<a class="todo-item-info'+ todoInfo +'"><i class="feather icon-info"></i></a>' +
                            '<a class="todo-item-favorite'+ todoFav +'"><i class="feather icon-star"></i></a>' +
                            '<a class="todo-item-delete"><i class="feather icon-trash"></i></a>' +
                        '</div>' +
                        '</div>' +
                        '<p class="mb-0 todo-desc truncate">'+ todoDesc +'</p>' +
                    '</li>');
                }

                $('#form-edit-todo .edit-todo-item-title').val(todoTitle);
                $('#form-edit-todo .edit-todo-item-desc').val(todoDesc);
                $('#form-edit-todo .dropdown-menu input').prop("checked", false);
                if($('#form-edit-todo .edit-todo-item-info').hasClass('success')){$('#form-edit-todo .edit-todo-item-info').addClass('success')}
                if($('#form-edit-todo .edit-todo-item-favorite').hasClass('warning')){$('#form-edit-todo .edit-todo-item-favorite').addClass('warning')}
            });


            // --------------------------------------------
            // To update todo list item
            // --------------------------------------------
            $(document).on('click',".todo-task-list-wrapper .todo-item", function(e){
                var t = $('.action-modal');
                $.ajax({
                    url: $(this).data('href'),
                    dataType: "html",
                    success: function(e) {
                        $(t).html(e).modal("show")
                    }
                })
                // // Saving all values in variable
                // $curr_title = $(this).find('.todo-title');  // Set path for Current Title, use this variable when updating title
                // $curr_desc = $(this).find('.todo-desc');  // Set path for Current Description, use this variable when updating Description
                // $curr_info = $(this).find('.todo-item-info');  // Set path for Current info, use this variable when updating info
                // $curr_fav = $(this).find('.todo-item-favorite'); // Set path for Current favorite, use this variable when updating favorite
                // $curr_chipVal = $(this).find('.chip-wrapper'); // Set path for Chips, use this variable when updating chip value

                // var $title = $(this).find('.todo-title').html();
                // var $desc = $(this).find('.todo-desc').html();
                // var $info = $(this).find('.todo-item-info');
                // var $fav = $(this).find('.todo-item-favorite');
                // $('#form-edit-todo .dropdown-menu input').prop("checked",false);


                // // Checkbox checked as per chips
                // var selected  = $(this).find('.chip');
                // selected.each(function(){
                //     var chipVal = $(this).find('.chip-text').data('value');
                //     $('#form-edit-todo .dropdown-menu input[data-value="'+chipVal+'"]').prop("checked",true);
                // });

                // // apply all variable values to fields
                // $('#form-edit-todo .edit-todo-item-title').val($title);
                // $('#form-edit-todo .edit-todo-item-desc').val($desc);

                // if($('#form-edit-todo .todo-item-info').hasClass('success')){$('#form-edit-todo .todo-item-info').removeClass('success')}
                // if($('#form-edit-todo .edit-todo-item-favorite').hasClass('warning')){$('#form-edit-todo .edit-todo-item-favorite').removeClass('warning')}

                // if( $($info).hasClass('success') ) {
                //     $('#form-edit-todo .todo-item-info').addClass('success');
                // }

                // if( $($fav).hasClass('warning') ) {
                //     $('#form-edit-todo .edit-todo-item-favorite').addClass('warning');
                // }
            });


            // --------------------------------------------
            // Updating Data Values to Fields
            // --------------------------------------------
            $('.update-todo-item').on('click', function(){
                var $edit_title = $('#form-edit-todo .edit-todo-item-title').val();
                var $edit_desc = $('#form-edit-todo .edit-todo-item-desc').val();
                var $edit_info = $('#form-edit-todo .todo-item-info i');
                var $edit_fav = $('#form-edit-todo .todo-item-favorite i');

                $($curr_title).text($edit_title);
                $($curr_desc).text($edit_desc);

                if($($curr_info).hasClass('success')){$($curr_info).removeClass('success')}
                if($($curr_fav).hasClass('warning')){$($curr_fav).removeClass('warning')}

                if( $($edit_info).parent('.todo-item-info').hasClass('success')) {
                    $curr_info.addClass('success');
                }

                if( $($edit_fav).parent('.todo-item-favorite').hasClass('warning')) {
                    $curr_fav.addClass('warning');
                }

                // Chip calculation loop
                var $edit_selected  = $('#form-edit-todo .dropdown-menu input:checked');
                var $edit_todoChip = "";

                $edit_selected.each(function(){
                    $edit_todoChip += '<div class="chip mb-0">' +
                        '<div class="chip-body">' +
                        '<span class="chip-text" data-value="'+$(this).data('value')+'"><span class="bullet bullet-'+$(this).data('color')+' bullet-xs"></span> '+$(this).data('value')+'</span>' +
                        '</div>' +
                    '</div>';
                });

                $curr_chipVal.empty();

                $($curr_chipVal).append($edit_todoChip);
                
            });

            // --------------------------------------------
            //EVENT DELETION
            // --------------------------------------------
            $(document).on('click', '.todo-item-delete', function(e){
                var item = this;
                e.stopPropagation();
                $(item).closest('.todo-item').remove();
            })

            // Complete task strike through   
            $(document).on('click', '.todo-item input', function(event){
                event.stopPropagation();
                $(this).closest('.todo-item').toggleClass("completed");
            });
    
            $("#todo-search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                if(value!=""){
                    $(".todo-item").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                    var tbl_row = $(".todo-item:visible").length; //here tbl_test is table name

                    if ( tbl_row == 0 ){
                        if(!$('.no-results').hasClass('show') ){
                            $('.no-results').addClass('show');
                        }
                    } else{
                        $('.no-results').removeClass('show');
                    }
                } else {
                    $(".todo-item").show();
                    if($('.no-results').hasClass('show') ){
                        $('.no-results').removeClass('show');
                    }
                }
            });

        });

        $(window).on("resize", function() {
            // remove show classes from sidebar and overlay if size is > 992
            if ($(window).width() > 992) {
                if($('.app-content .app-content-overlay').hasClass('show')){
                    $('.app-content .sidebar-left').removeClass('show');
                    $('.app-content .app-content-overlay').removeClass('show');
                }
            }
        });
    </script>
@endsection