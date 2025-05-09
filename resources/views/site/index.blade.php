@extends('site.layouts.master')
@section('content')
    <main class="main">
        <section id="hero" class="hero section light-background">
            <img src="{{ asset('medilab/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">
            <div class="container position-relative">
                <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
                    <h2>Selamat datang Di Medix</h2>
                </div>
                <div class="content row gy-4">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
                            <h3>Kenapa Memilih Medix?</h3>
                            <p>
                                Di Medix, kami percaya bahwa kesehatan adalah investasi terbaik untuk masa depan. Dengan pengalaman bertahun-tahun di bidang medis, kami hadir untuk memberikan pelayanan yang berkualitas dan terpercaya bagi setiap pasien.
                            </p>
                            <div class="text-center">
                                <a href="/about" class="more-btn"><span>Selengkapnya</span> <i
                                        class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="d-flex flex-column justify-content-center">
                            <div class="row gy-4">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                                        <i class="bi bi-clipboard-data"></i>
                                        <h4>Pelayanan Medis Terbaik</h4>
                                        <p>Kami menyediakan layanan kesehatan dengan teknologi modern dan tim medis berpengalaman untuk menjamin kualitas perawatan terbaik bagi Anda</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                                        <i class="bi bi-gem"></i>
                                        <h4>Kepercayaan Pasien adalah Prioritas Kami</h4>
                                        <p>Kami berkomitmen untuk memberikan layanan dengan transparansi, kejujuran, dan empati kepada setiap pasien yang mempercayakan kesehatannya kepada Medix.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                        <i class="bi bi-inboxes"></i>
                                        <h4>Kemudahan Akses Kesehatan</h4>
                                        <p>Dapatkan layanan kesehatan dengan mudah melalui sistem online kami. Buat janji temu, konsultasi dengan dokter, dan akses rekam medis kapan saja dan di mana saja.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
