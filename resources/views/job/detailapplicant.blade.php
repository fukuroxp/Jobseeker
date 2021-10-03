@extends('layouts.app')

@section('content')
<section class="page-users-view">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Diri</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="users-view-image">
                            <img src="{{ $data->user->image ? asset('uploads/images/'.$data->user->image) : asset('uploads/images/profile.png') }}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                        </div>
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">Nama</td>
                                    <td>{{ $data->user->profile->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">JK</td>
                                    <td>{{ $data->user->profile->jk ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">TTL</td>
                                    <td>{{ $data->user->profile->ttl ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Asal</td>
                                    <td>{{ $data->user->profile->asal ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Domisili</td>
                                    <td>{{ $data->user->profile->domisili ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <?php
                                        if($data->user->profile->notelpon[0] == 6)
                                        {
                                            $no_telp =$data->user->profile->notelpon;
                                        }
                                        elseif($data->user->profile->notelpon[0] == 0)
                                        {
                                            $sub_str = substr($data->user->profile->notelpon, 1);
                                            $no_telp = '62'.$sub_str;
                                        }
                                        else{
                                            $no_telp = '62'.$data->user->profile->notelpon;
                                        }
                                    ?>
                                                        
                                    <td class="font-weight-bold">No. Telepon</td>
                                    <td><a href="whatsapp://send?phone={{$no_telp}}">{{ $data->user->profile->notelpon ?? '-' }}</a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td><a href="mailto:{{ $data->user->profile->email ?? $data->user->email }}">{{ $data->user->profile->email ?? $data->user->email }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tb</td>
                                    <td>{{ $data->user->profile->tb ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Bb</td>
                                    <td>{{ $data->user->profile->bb ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Hobi</td>
                                    <td>{{ $data->user->profile->hobi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Skill</td>
                                    <td>{{ $data->user->profile->skill ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Data Pendidikan</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus SD</td>
                                    <td>{{ $data->user->profile->sd ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus SMP</td>
                                    <td>{{ $data->user->profile->smp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus SMA</td>
                                    <td>{{ $data->user->profile->sma ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus S1</td>
                                    <td>{{ $data->user->profile->s1 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus S2</td>
                                    <td>{{ $data->user->profile->s2 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus S3</td>
                                    <td>{{ $data->user->profile->s3 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kursus/Sertifkasi</td>
                                    <td>{{ $data->user->profile->kursus ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tr>
                                    <td class="font-weight-bold">Ijazah SD</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->ijazahsd ? asset('uploads/file/'. $data->user->profile->ijazahsd) : '#' }}">{{ $data->user->profile->ijazahsd != NULL ? 'File Ijazah SD' : '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah SMP</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->ijazahsmp ? asset('uploads/file/'. $data->user->profile->ijazahsmp) : '#' }}">{{ $data->user->profile->ijazahsmp != NULL ? 'File Ijazah SMP' : '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah SMA</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->ijazahsma ? asset('uploads/file/'. $data->user->profile->ijazahsma) : '#' }}">{{ $data->user->profile->ijazahsma != NULL ? 'File Ijazah SMA' : '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah S1</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->ijazahs1 ? asset('uploads/file/'. $data->user->profile->ijazahs1) : '#' }}">{{ $data->user->profile->ijazahs1 != NULL ? 'File Ijazah S1' : '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah S2</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->ijazahs2 ? asset('uploads/file/'. $data->user->profile->ijazahs2) : '#' }}">{{ $data->user->profile->ijazahs2 != NULL ? 'File Ijazah S2' : '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah S3</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->ijazahs3 ? asset('uploads/file/'. $data->user->profile->ijazahs3) : '#' }}">{{ $data->user->profile->ijazahs3 != NULL ? 'File Ijazah S3' : '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Bukti</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->bukti ? asset('uploads/file/'. $data->user->profile->bukti) : '#' }}">{{ $data->user->profile->bukti != NULL ? 'File Bukti Kursus' : '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Portofolio</td>
                                    <td><a target="_blank" href="{{ $data->user->profile->portofolio ? asset('uploads/file/'. $data->user->profile->portofolio) : '#' }}">{{ $data->user->profile->portofolio != NULL ? 'File Portofolio' : '-' }}</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">Pengalaman Organisasi</div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="font-weight-bold">Kategori</td>
                            <td>{{ $data->user->profile->kategori ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jabatan</td>
                            <td>{{ $data->user->profile->jabatan ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Periode</td>
                            <td>{{ $data->user->profile->periode ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">Pengalaman Bekerja</div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="font-weight-bold">Nama Perusahaan</td>
                            <td>{{ $data->user->profile->nama_perusahaan ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jenis Usaha</td>
                            <td>{{ $data->user->profile->jenis_usaha ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Bagian</td>
                            <td>{{ $data->user->profile->bagian ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Lama Bekerja</td>
                            <td>{{ $data->user->profile->lama_bekerja ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">Catatan Pelamar</div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="font-weight-bold">Note</td>
                            <td>{!! $data->note ?? '-' !!}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Status</td>
                            <td><strong>{{ $data->status ?? '-' }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Lapiran</td>
                            <td><a target="_blank" href="{{ $data->lampiran ? asset('uploads/lampiran/'. $data->lampiran) : '#' }}">{{ $data->lampiran != NULL ? 'File Lampiran' : '-' }}</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection