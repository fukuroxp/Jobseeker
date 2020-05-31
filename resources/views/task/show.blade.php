<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary white">
            <h4 class="modal-title" id="exampleModalLabel">#{{ $data->label ?? '' }} - {{ $data->name ?? '' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @php
            $is_turned_in = false;
            if($data->task_user) {
                if($data->task_user->is_turned_in) {
                    $is_turned_in = true;
                }
            }
        @endphp
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-8">
                    <p>{{ $data->description }}</p>
                    <hr>
                    <div class="card w-100">
                        <a target="_blank" href="{{ asset('uploads/file/'.$data->file) }}">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="fa fa-file-pdf fa-4x"></i>
                                    </div>
                                    <div class="col-sm-11 align-self-center">
                                        @php
                                            $label = (strpos($data->file, '_')) ? explode('_', $data->file)[1] : $data->file;
                                        @endphp
                                        <strong> {{ \Str::limit($label, 50, $end='...') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mt-2">
                        <div class="card-header d-flex flex-column align-items-start pb-0">
                            <h4 class="text-bold-700">Pekerjaanmu @if($is_turned_in) <i class="fa fa-check text-success"></i>@endif</h4>
                        </div>
                        <div class="card-content">
                            {!! Form::open(['url' => route('task.submit', [$data->id]), 'method' => 'post', 'files' => true, 'id' => 'submit_task']) !!}
                            <fieldset class="form-group pl-2 pr-2 mb-1 mt-1">
                                <div class="custom-file">
                                    <input id="file_task" type="file" class="custom-file-input">
                                    <label class="custom-file-label" for="file_task">Pilih file</label>
                                </div>
                            </fieldset>
                            <div class="float-center">
                                <button type="submit" class="btn {{ $is_turned_in ? 'btn-warning' : 'btn-primary' }} mt-0 w-100 btn-submit">{{ $is_turned_in ? 'Upload Ulang' : 'Upload' }}</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="chip-wrapper">
                <div class="chip mb-0">
                    <div class="chip-body chip-status">
                        @if ($is_turned_in)
                            <span class="chip-text"><span class="fa text-success fa-xs fa-check"></span> Selesai</span>
                        @else
                            <span class="chip-text"><span class="fa text-danger fa-xs fa-exclamation-circle"></span> Deadline {{ date('d/m/Y', strtotime($data->due_at)) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("form").submit(function(e){
            e.preventDefault(e);

            var form = $(this);
            var file_data = $('#file_task').prop('files')[0];
            var formData = new FormData($("#submit_task")[0]);             
            formData.append('file', file_data);

            Swal.fire({
                title: 'Anda yakin?',
                text: "Anda akan menyimpan data tugas ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: form.attr("action"),
                        method: 'POST',
                        enctype: 'multipart/form-data',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if(res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: res.message
                                }).then((result) => {
                                    $('.btn-submit').removeClass("btn-primary");
                                    $('.btn-submit').addClass('btn-warning');
                                    $('.btn-submit').html('Upload Ulang');
                                    $('.chip-status').html('<span class="chip-text"><span class="fa text-success fa-xs fa-check"></span> Selesai</span>');
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
    });
</script>