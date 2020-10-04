@extends('layouts.app')

@section('content')
<section id="validation">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Curriculum Vitae</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('setting.storeProfile') }}" class="steps-validation wizard-circle" method="POST" enctype="multipart/form-data" id="profile">
                        @csrf
                            <!-- Step 1 -->
                            <h6>Data Diri</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control required" id="nama" name="nama" value="{{ $data->nama ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ttl">TTL</label>
                                            <input type="text" class="form-control required" id="ttl" name="ttl" value="{{ $data->ttl ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="asal">Alamat Asal</label>
                                            <input type="text" class="form-control required" id="asal" name="asal" value="{{ $data->asal ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="domisili">Alamat Domisili</label>
                                            <input type="text" class="form-control required" id="domisili" name="domisili" value="{{ $data->domisili ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="notelpon">Nomor Telepon</label>
                                            <input type="text" class="form-control required" id="notelpon" name="notelpon" value="{{ $data->notelpon ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control required" id="email" name="email" value="{{ $data->email ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="jk">Jenis Kelamin</label>
                                            <select class="custom-select form-control required" id="jk" name="jk">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="tb">Tinggi Badan</label>
                                            <input type="text" class="form-control required" id="tb" name="tb" value="{{ $data->tb ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="bb">Berat Badan</label>
                                            <input type="text" class="form-control required" id="bb" name="bb" value="{{ $data->bb ?? '' }}">
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="hobi">Hobi</label>
                                            <input type="text" class="form-control required" id="hobi" name="hobi" value="{{ $data->hobi ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="skill">Skill</label>
                                            <input type="text" class="form-control required" id="skill" name="skill" value="{{ $data->skill ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Step 2 -->
                            <h6>Data Pendidikan</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5>Formal</h5>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="sd">Tahun Lulus SD</label>
                                                <input type="text" class="form-control" id="sd" name="sd" value="{{ $data->sd ?? '' }}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-4">
                                            <fieldset class="form-group">
                                                <label for="ijazahsd">Ijazah SD</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazahsd" name="ijazahsd">
                                                    <label class="custom-file-label" for="ijazahsd">Pilih file</label>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="smp">Tahun Lulus SMP</label>
                                                <input type="text" class="form-control" id="smp" name="smp" value="{{ $data->smp ?? '' }}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-4">
                                            <fieldset class="form-group">
                                                <label for="ijazahsmp">Ijazah SMP</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazahsmp" name="ijazahsmp">
                                                    <label class="custom-file-label" for="ijazahsmp">Pilih file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="sma">Tahun Lulus SMA</label>
                                                <input type="text" class="form-control" id="sma" name="sma" value="{{ $data->sma ?? '' }}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-4">
                                            <fieldset class="form-group">
                                                <label for="ijazahsma">Ijazah SMA</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazahsma" name="ijazahsma">
                                                    <label class="custom-file-label" for="ijazahsma">Pilih file</label>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="s1">Tahun Lulus S1</label>
                                                <input type="text" class="form-control" id="s1" name="s1" value="{{ $data->s1 ?? '' }}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-4">
                                            <fieldset class="form-group">
                                                <label for="ijazahs1">Ijazah S1</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazahs1" name="ijazahs1">
                                                    <label class="custom-file-label" for="ijazahs1">Pilih file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="s2">Tahun Lulus S2</label>
                                                <input type="text" class="form-control" id="s2" name="s2" value="{{ $data->s2 ?? '' }}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-4">
                                            <fieldset class="form-group">
                                                <label for="ijazahs2">Ijazah S2</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazahs2" name="ijazahs2">
                                                    <label class="custom-file-label" for="ijazahs2">Pilih file</label>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="s3">Tahun Lulus S3</label>
                                                <input type="text" class="form-control" name="s3" id="s3" value="{{ $data->s3 ?? '' }}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-4">
                                            <fieldset class="form-group">
                                                <label for="ijazahs3">Ijazah S3</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ijazahs3" name="ijazahs3">
                                                    <label class="custom-file-label" for="ijazahs3">Pilih file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5>Informal</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="kursus">Kursus/Sertifikasi</label>
                                                <input type="text" class="form-control" id="kursus" name="kursus" value="{{ $data->kursus ?? '' }}">
                                            </div>
                                        </div>
    
                                        <div class="col-sm-6">
                                            <fieldset class="form-group">
                                                <label for="bukti">Bukti/Sertifikat</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="bukti" name="bukti">
                                                    <label class="custom-file-label" for="bukti">Pilih file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                            </fieldset>

                            <!-- Step 3 -->
                            <h6>Pengalaman Organisasi</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select class="custom-select form-control" id="kategori" name="kategori">
                                                <option disabled selected>Pilih</option>
                                                <option value="Kampus">Kampus</option>
                                                <option value="Karang Taruna">Karang Taruna</option>
                                                <option value="Sekolah">Sekolah</option>
                                                <option value="Remaja Masjid">Remaja Masjid</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="jabatan">Sebagai</label>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $data->jabatan ?? '' }}">
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="periode">Masa Periode</label>
                                            <input type="text" class="form-control" id="periode" name="periode" value="{{ $data->periode ?? '' }}">
                                        </div>
                                    </div>
                                </div>  
                            </fieldset>

                            <!-- Step 4 -->
                            <h6>Pengalaman Bekerja</h6>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nama_perusahaan">Nama Perusahaan</label>
                                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ $data->nama_perusahaan ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="jenis_usaha">Jenis Usaha</label>
                                            <input type="text" class="form-control" id="jenis_usaha" name="jenis_usaha" value="{{ $data->jenis_usaha ?? '' }}">
                                        </div>
                                    </div>
                                </div>  

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="bagian">Bagian</label>
                                            <input type="text" class="form-control" id="bagian" name="bagian" value="{{ $data->bagian ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lama_bekerja">Lama Bekerja</label>
                                            <input type="text" class="form-control" id="lama_bekerja" name="lama_bekerja" value="{{ $data->lama_bekerja ?? '' }}">
                                        </div>
                                    </div>
                                </div>  
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection