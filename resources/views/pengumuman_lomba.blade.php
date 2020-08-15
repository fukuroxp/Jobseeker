@extends('layouts.landing')

@section('content')
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads/images/IMG_5399.jpg') }}">
        </div>
        <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads/images/IMG_5403.jpg') }}">
        </div>
        <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads/images/IMG_5434.jpg') }}">
        </div>
        <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads/images/IMG_5449.jpg') }}">
        </div>
        <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads/images/IMG_5451.jpg') }}">
        </div>
        <div class="single-hero-items set-bg" data-setbg="{{ asset('uploads/images/IMG_5462.jpg') }}">
        </div>
        {{-- <div class="single-hero-items set-bg" data-setbg="{{ asset('fashi/img/hero-2.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <span>Bag,kids</span>
                        <h1>Black friday</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore</p>
                        <a href="#" class="primary-btn">Shop Now</a>
                    </div>
                </div>
                <div class="off-card">
                    <h2>Sale <span>50%</span></h2>
                </div>
            </div>
        </div> --}}
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
{{-- <div class="banner-section spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="{{ asset('fashi/img/banner-1.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Men’s</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="{{ asset('fashi/img/banner-2.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Women’s</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-banner">
                    <img src="{{ asset('fashi/img/banner-3.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Kid’s</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Banner Section End -->

<!-- Women Banner Section Begin -->
{{-- <section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-large set-bg" data-setbg="{{ asset('fashi/img/products/women-large.jpg') }}">
                    <h2>Women’s</h2>
                    <a href="#">Discover More</a>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="filter-control">
                    <ul>
                        <li class="active">Clothings</li>
                        <li>HandBag</li>
                        <li>Shoes</li>
                        <li>Accessories</li>
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/women-1.jpg') }}" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Coat</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $14.00
                                <span>$35.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/women-2.jpg') }}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Shoes</div>
                            <a href="#">
                                <h5>Guangzhou sweater</h5>
                            </a>
                            <div class="product-price">
                                $13.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/women-3.jpg') }}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/women-4.jpg') }}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Converse Shoes</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Women Banner Section End -->

<!-- Deal Of The Week Section Begin-->
<section class="deal-of-week set-bg spad mt-5 mb-5 pb-1" style="background-color: #f0eace">
    <div class="container">
        <div class="col-lg">
            <div class="section-title">
                <h2 class="text-center">Pengumuman Lomba</h2>
                <img src="https://i.imgur.com/sHkUeym.jpg" alt="" class="mb-5">
                
                <h2>LOMBA KREATIVITAS KETRAMPILAN & PRODUK<br>
                    BERBAHAN DASAR KARUNG GONI
                    </h2>
                <b>DALAM RANGKA MEMPERINGATI HUT DHARMA WANITA PERSATUAN KE 21</b>
                <p class="text-left"><b>Ketentuan Lomba :</b></p>
                <ol type="A" class="ml-4">
                    <li class="text-left">
                        <b>Peserta</b>
                        <ol type="1" class="text-left ml-4">
                            <li>
                                Diikuti oleh semua DWP Cabdindik Wilayah Kabupaten dan Kota Se-Jawa Timur dengan melakukan pendaftaran secara online, ketentuan berlaku*)
                            </li>
                        </ol>
                    </li>
                    <li class="text-left">
                        <b>Produk</b>
                        <ol type="1" class="text-left ml-4">
                            <li>Membuat 2 produk berbahan dasar karung goni</li>
                            <li>Produk yang dikirim adalah ciptaan sendiri, belum pernah memenangkan penghargaan dalam lomba dan festival apapun serta belum perah digunakan untuk tujuan komersil</li>
                            <li>Produk berbahan kasung goni 50% dengan nilai produk jadi tidak boleh lebih dari Rp 75.000,- (menggunakan bahan dalam negeri, bermanfaat dan ramah lingkungan)</li>
                            <li>Produk difoto dan divideokan</li>
                            <li>Produk dikumpulkan atau dikirimkan kepada panitia lomba di Kantor Dinas Pendidikan Provinsi Jawa Timur.</li>
                        </ol>
                    </li>
                    <li class="text-left">
                        <b>Timeline Lomba</b>
                        <ol type="1" class="text-left ml-4">
                            <li>
                                <b>9 – 15 Agustus 2020</b><br>
                                Sosialisasi dan pelatihan dengan video tutorial
                            </li>
                            <li>
                                <b>15 – 20 Agustus 2020</b><br>
                                Pendaftaran secara online di website <a href="http://www.dwpdindikjatim.org">www.dwpdindikjatim.org</a>
                            </li>
                            <li>
                                <b>20 – 3 September 2020</b><br>
                                Pengiriman foto, video dan produk
                            </li>
                            <li>
                                <b>4 – 10 September 2020</b><br>
                                Penjurian
                            </li>
                            <li>
                                <b>12 September 2020</b><br>
                                Pengumuman Pemenang
                            </li>
                        </ol>
                    </li>
                    <li class="text-left">
                        <b>Berikut adalah link syarat ketentuan lengkap beserta form pendaftaran lomba :</b>
                        <ol type="1" class="text-left ml-4">
                            <li>
                                <b>Video Sambutan Ketua Dwp Dindik Jatim Dan Tutorial Keterampilan membuat produk </b><br>
                                <a href="https://bit.ly/VideoSambutanKetuaDWPDindikdanTutorial">https://bit.ly/VideoSambutanKetuaDWPDindikdanTutorial</a>
                            </li>
                            <li>
                                <b>Petunjuk Pelaksanaan </b><br>
                                <a href="https://bit.ly/PetunjukPelaksanaanLombaDWPDindikJatim">https://bit.ly/PetunjukPelaksanaanLombaDWPDindikJatim</a>
                            </li>
                            <li>
                                <b>Pendaftaran</b><br>
                                <a href="https://bit.ly/FormulirPendaftaranLomba-DWPDindikJatim">https://bit.ly/FormulirPendaftaranLomba-DWPDindikJatim</a>
                            </li>
                            <li>
                                <b>Unggah Foto & Video</b><br>
                                <a href="https://bit.ly/Form-unggah-foto-dan-video-dwpdindikjatim">https://bit.ly/Form-unggah-foto-dan-video-dwpdindikjatim</a>
                            </li>
                        </ol>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Deal Of The Week Section End -->

<!-- Man Banner Section Begin -->
{{-- <section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="filter-control">
                    <ul>
                        <li class="active">Clothings</li>
                        <li>HandBag</li>
                        <li>Shoes</li>
                        <li>Accessories</li>
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/man-1.jpg') }}" alt="">
                            <div class="sale">Sale</div>
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Coat</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $14.00
                                <span>$35.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/man-2.jpg') }}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Shoes</div>
                            <a href="#">
                                <h5>Guangzhou sweater</h5>
                            </a>
                            <div class="product-price">
                                $13.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/man-3.jpg') }}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Pure Pineapple</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('fashi/img/products/man-4.jpg') }}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="#">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">Towel</div>
                            <a href="#">
                                <h5>Converse Shoes</h5>
                            </a>
                            <div class="product-price">
                                $34.00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large" data-setbg="{{ asset('fashi/img/products/man-large.jpg') }}">
                    <h2>Men’s</h2>
                    <a href="#">Discover More</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Man Banner Section End -->

<!-- Instagram Section Begin -->
{{-- <div class="instagram-photo">
    <div class="insta-item set-bg" data-setbg="{{ asset('fashi/img/insta-1.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('fashi/img/insta-2.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('fashi/img/insta-3.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('fashi/img/insta-4.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('fashi/img/insta-5.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('fashi/img/insta-6.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
</div> --}}
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
{{-- <section class="latest-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ asset('fashi/img/latest-1.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>The Best Street Style From London Fashion Week</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ asset('fashi/img/latest-2.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ asset('fashi/img/latest-3.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="#">
                            <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="benefit-items">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ asset('fashi/img/icon-1.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Free Shipping</h6>
                            <p>For all order over 99$</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ asset('fashi/img/icon-2.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Delivery On Time</h6>
                            <p>If good have prolems</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ asset('fashi/img/icon-1.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Secure Payment</h6>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Latest Blog Section End -->
@endsection