@extends('site.layouts.master')
@section('content')
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4 gx-5 mt-5">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('medilab/img/about.jpg') }}" class="img-fluid" alt="">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <h3>Tentang Kami</h3>
                    <p>
                        Di Medix, kami percaya bahwa kesehatan adalah investasi terbaik untuk masa depan. Dengan pengalaman bertahun-tahun di bidang medis, kami hadir untuk memberikan pelayanan yang berkualitas dan terpercaya bagi setiap pasien.
                    </p>
                    <ul>
                        <li>
                            <i class="fa-solid fa-vial-circle-check"></i>
                            <div>
                                <h5>Siapa Kami?</h5>
                                <p>Medix adalah pusat layanan kesehatan yang menggabungkan keahlian medis, teknologi canggih, dan pelayanan yang ramah untuk memastikan setiap pasien mendapatkan perawatan terbaik.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-pump-medical"></i>
                            <div>
                                <h5>Visi dan Misi Kami</h5>
                                <p>Memberikan layanan kesehatan yang holistik, inovatif, dan berorientasi pada pasien, sehingga setiap individu dapat hidup lebih sehat dan bahagia.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection