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
                <h2 class="text-center">Sejarah Dharma Wanita</h2>
                <p class="text-left" style="text-indent: 50px;">Sejarah Dharma Wanita Persatuan berawal pada 5 Agustus 1974 saat organisasi para Isteri Pegawai Republik Indonesia pada masa Pemrintahan Orde Baru itu dibentuk dengan nama Dharma Wanita. Organisasi ini didirikan oleh Ketua Dewan Pembina KORPRI saat itu, Amir Machmud, atas prakarsa Ibu Tien Soeharto sebagai Ibu Negara, pada waktu itu Dharma Wanita beranggotakan para Istri Pegawai Republik Indonesia, Anggota ABRI yang dikaryakan dan Pegawai BUMN.</p>
                <p class="text-left" style="text-indent: 50px;">Pada era Reformasi tahun 1998, organisasi wanita ini melakukan perubahan mendasar, tidak ada lagi muatan politik dari Pemerintah. Dharma Wanita menjadi organisasi sosial kemasyarakatan yang netral dari politik, Independen dan Demokrasi. Nama Dharma Wanita kemudian berubah menjadi Dharma Wanita Persatuan, penambahan kata “Persatuan” disesuaikan dengan nama Kabinet Persatuan Nasional dibawah kepemimpinan Presiden Abdurrahman Wahid. Perubahan organisasi ini tidak terbatas pada penambahan kata Persatuan namun juga berubah menjadi organisasi yang mandiri dan Demokrasi.</p>
                <p class="text-left" style="text-indent: 50px;">Pada Munas Luar Biasa (Munaslub) Dharma Wanita yang diselenggarakan pada tanggal 6 – 7 Desember 1999, seluruh rancangan Anggaran Dasar disahkan dan menetapkan Ketua Umum Dharma Wanita Persatuan terpilih, Ny. Dr. Nila F. Moeloek. Pokok-pokok perubahan organisasi Dharma Wanita yang ditetapkan pada Munaslub antara lain :</p>
                <ol class="text-left ml-5">
                    <li>Nama organisasi   berubah   menjadi   Dharma   Wanita Persatuan;</li>
                    <li>Istilah Istri Pegawai Republik Indonesia diganti menjadi Istri Pegawai Negeri Sipil Republik Indonesia;</li>
                    <li>Penegasan sebagai organisasi sosial kemasyarakatan yang bergerak dibidang Pendidikan, Ekonomi dan Sosial Budaya</li>
                    <li>Penegasan sebagai organisasi non politik;</li>
                    <li>Penerapan demokrasi dalam organisasi dalam organisasi (Ketua Umum dan Ketua pada Unsur Pelaksana dipilih secara Demokrasi).</li>
                </ol><br>
                <p class="text-left" style="text-indent: 50px;">Sebagai salah satu organisasi masyarakat (ormas) perempuan terbesar di Indonesia, sudah selayaknya Dharma Wanita Persatuan memiliki Standing Position dan mengambil peran strategis dalam konstalasi pembangunan nasional, sebagaimana ormas lainnya, Dharma Wanita Persatuan memiliki peluang untuk berkiprah lebih luas dengan mengoptimalisasikan peran sertanya sebagaimana yang diatur pada pasal 5 Undang-undang Nomor 17 Tahun 2013 Tentang Organisasi Kemasyrakatan, (“UU No.17 Th. 2013”) yang menyebutkan bahwa pembentukan ormas bertujuan :</p>
                <ol class="text-left ml-5">
                    <li>Meningkatkan partisipasi dan keberdayaan masyarakat;</li>
                    <li>Memberikan pelayanan kepada masyarakat;</li>
                    <li>Menjaga nilai agama dan kepercayaan terhadap Tuhan Yang Maha Esa;</li>
                    <li>Melestarikan dan memelihara norma, nilai, moral, etika dan budaya yang hidup dalam masyarakat;</li>
                    <li>Melestarikan sumber daya alam dan lingkungan hidup;</li>
                    <li>Mengembangkan kesetiakawanan  sosial,  gotong  royong dan bertoleransi dalam kehidupan bermasyarakat;</li>
                    <li>Menjaga, memelihara  dan  memperkuat  persatuan  dan kesatuan Bangsa, dan</li>
                    <li>Mewujudkan tujuan</li>
                </ol><br>
                <p class="text-left">Dengan mengacu pada ketentuan pasal 37 ayat 1 UU No. 17 Th.2013 , yang menyatakan bahwa keuangan ormas dapat bersumber dari :</p>
                <ol class="text-left ml-5">
                    <li>Iuran Anggota;</li>
                    <li>Bantuan/ sumbangan masyarakat;</li>
                    <li>Hasil usaha Ormas;</li>
                    <li>Bantuan/sumbangan dari orang asing/ lembaga asing;</li>
                    <li>Kegiatan lain yang sah menurut hukum, dan /</li>
                    <li>Anggaran pendapatan  belanja  negara  dan  /  anggaran pendapatan belanja maka sumber keuangan Dharma Wanita Persatuan tidak akan bertentangan dengan yang telah diatur dalam UU No. 17 Th. 2013.</li>
                </ol><br>
                <p class="text-left" style="text-indent: 50px;">Pada sisi lain, dengan telah diterbitkannya Undang-undang Nomor 5 tahun 2014 tentang Aparatur Sipil Negara, maka Dharma Wanita Persatuan harus meyelaraskan diri dengan tuntutan perubahan lingkungan sekitarnya.  Pemerintah telah membuat Rancangan Teknokratis Rencana Pembangunan Jangka Menengah Nasional (RPJMN) yang dilengkapi dengan Visi Misi kebijakan dan program Presiden terpilih dan ditetapkan menjadi RPJMN, sehingga Dharma Wanita Persatuan selalu berusaha menyesuaikan dan menetapkan Rencana Strategis Organisasi yang sejalan dangan arahan dan agenda RPJMN yang ditetapkan oleh Pemerintah. Hal ini dilakukan dalam rangka meningkatkan kapabilitas dan kapasitas Dharma Wanita Persatuan untuk pencapaian Pembangunan Nasional sebagaiamana di tuangkan dalam RPJMN tersebut.</p>
                <p class="text-left" style="text-indent: 50px;">Pada Musyawarah Nasional (“Munas”) Ke IV Dharma Wanita Persatuan yang dilaksanakan pada tanggal 12 – 13 Desember 2019 telah menghasilkan beberapa keputusan penting yaitu antara lain Perubahan Anggaran Dasar Dharma Wanita dan Rencana Strategis Dharma Wanita Persatuan untuk tahun 2020 – 2024.</p>
                <p class="text-left" style="text-indent: 50px;">Sesuai hasil Munas Ke IV, perubahan mendasar dalam Anggaran Dasar Dharma Wanita Persatuan yaitu antara lain tentang ketentuan atau pasal-pasal mengenai :</p>
                <ol class="text-left ml-5">
                    <li><b>Ketua Umum</b> Dijabat oleh isteri Menteri yang membidangi Aparatur Negara.</li>
                    <li><b>Ketua DWP</b> Jabatan Ketua DWP melekat pada isteri Sekjen/ Sesmenko/ Sesmen/ Sestama/ Sekda serta isteri kepala LPNK</li>
                    <li><b>Pengurus DWP</b> Pengurus DWP dijabat oleh isteri Aparatur Sipil Negara aktif</li>
                    <li><b>Ketua DWP/Provinsi/Kabupaten/Kota/Kecamatan/Kelurahan</b> Sebelumnya dipilih menjadi ex – oficio, masa jabatan mengikuti masa jabatan suami</li>
                    <li><b>Dewan Kehormatan DWP</b> Beranggotaka isteri mantan Presiden atau Wakil Presiden dan mantan Ketua Umum</li>
                    <li><b>Dewan Penasihat</b> Penambahan Ketua MK, Ketua KY, dan pejabat setingkat Menteri</li>
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