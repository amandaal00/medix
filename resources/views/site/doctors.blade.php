@extends('site.layouts.master')
@section('content')
<section id="doctors" class="doctors section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Dokter</h2>
        <p>Di Medix, kami memiliki tim dokter profesional dengan keahlian di berbagai bidang medis. Dengan pengalaman dan komitmen tinggi, mereka siap memberikan pelayanan terbaik untuk kesehatan Anda dan keluarga.</p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="team-member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset('medilab/img/doctors/doctors-1.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>Walter White</h4>
                        <span>Chief Medical Officer</span>
                        <p>Memimpin tim medis dengan pengalaman luas dan pendekatan inovatif dalam dunia kesehatan.</p>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""> <i class="bi bi-linkedin"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="team-member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset('medilab/img/doctors/doctors-2.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>Sarah Jhonson</h4>
                        <span>Anesthesiologist</span>
                        <p>Ahli dalam teknik anestesi yang memastikan kenyamanan dan keselamatan pasien selama prosedur medis.</p>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""> <i class="bi bi-linkedin"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="team-member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset('medilab/img/doctors/doctors-3.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>William Anderson</h4>
                        <span>Cardiology</span>
                        <p>Spesialis jantung yang berfokus pada pencegahan dan penanganan penyakit kardiovaskular.</p>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""> <i class="bi bi-linkedin"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="team-member d-flex align-items-start">
                    <div class="pic"><img src="{{ asset('medilab/img/doctors/doctors-4.jpg') }}"
                            class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>Amanda Jepson</h4>
                        <span>Neurosurgeon</span>
                        <p>Dokter bedah saraf dengan keahlian dalam menangani kasus kompleks terkait sistem saraf.</p>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""> <i class="bi bi-linkedin"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection