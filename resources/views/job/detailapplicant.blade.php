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
                            <img src="{{ auth()->user()->image ? asset('uploads/images/'.auth()->user()->image) : asset('uploads/images/profile.png') }}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                        </div>
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tr>
                                    <td class="font-weight-bold">Nama</td>
                                    <td>{{ $data->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">JK</td>
                                    <td>{{ $data->jk ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">TTL</td>
                                    <td>{{ $data->ttl ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Asal</td>
                                    <td>{{ $data->asal ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Domisili</td>
                                    <td>{{ $data->domisili ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No. Telepon</td>
                                    <td>{{ $data->notelpon ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td>{{ $data->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tb</td>
                                    <td>{{ $data->tb ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Bb</td>
                                    <td>{{ $data->bb ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Hobi</td>
                                    <td>{{ $data->hobi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Skill</td>
                                    <td>{{ $data->skill ?? '-' }}</td>
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
                                    <td>{{ $data->sd ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus SMP</td>
                                    <td>{{ $data->smp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus SMA</td>
                                    <td>{{ $data->sma ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus S1</td>
                                    <td>{{ $data->s1 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus S2</td>
                                    <td>{{ $data->s2 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tahun Lulus S3</td>
                                    <td>{{ $data->s3 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kursus/Sertifkasi</td>
                                    <td>{{ $data->kursus ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tr>
                                    <td class="font-weight-bold">Ijazah SD</td>
                                    <td><a target="_blank" href="{{ asset('uploads/file/'. $data->ijazahsd) }}">{{ $data->ijazahsd ?? '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah SMP</td>
                                    <td><a target="_blank" href="{{ asset('uploads/file/'. $data->ijazahsmp) }}">{{ $data->ijazahsmp ?? '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah SMA</td>
                                    <td><a target="_blank" href="{{ asset('uploads/file'. $data->ijazahsma) }}">{{ $data->ijazahsma ?? '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah S1</td>
                                    <td><a target="_blank" href="{{ asset('uploads/file/'. $data->ijazahs1) }}">{{ $data->ijazahs1 ?? '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah S2</td>
                                    <td><a target="_blank" href="{{ asset('uploads/file/'. $data->ijazahs2) }}">{{ $data->ijazahs2 ?? '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ijazah S3</td>
                                    <td><a target="_blank" href="{{ asset('uploads/file'. $data->ijazahs3) }}">{{ $data->ijazahs3 ?? '-' }}</a></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Bukti</td>
                                    <td><a target="_blank" href="{{ asset('uploads/file'. $data->bukti) }}">{{ $data->bukti ?? '-' }}</a></td>
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
                            <td>{{ $data->kategori ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jabatan</td>
                            <td>{{ $data->jabatan ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Periode</td>
                            <td>{{ $data->periode ?? '-' }}
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
                            <td>{{ $data->nama_perusahaan ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Jenis Usaha</td>
                            <td>{{ $data->jenis_usaha ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Bagian</td>
                            <td>{{ $data->bagian ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Lama Bekerja</td>
                            <td>{{ $data->lama_bekerja ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection