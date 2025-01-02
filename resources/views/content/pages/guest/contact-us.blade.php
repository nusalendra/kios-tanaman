@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
    $isMenu = false;
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Contact Us')

@section('content')
    <div class="{{ $container }} py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-light rounded-4">
                    <div class="card-header text-center bg-secondary text-white p-5 rounded-3">
                        <h4 class="mb-3">Selamat Datang di Kios Tanaman Ciliwung</h4>
                        <p class="mb-0">Bagi Anda yang ingin memulai merawat tanaman, kami adalah website yang tepat untuk
                            membantu Anda memilih tanaman yang sesuai dengan favorit Anda. Kios Tanaman Ciliwung sudah
                            hampir 10 tahun beroperasi, menyediakan berbagai jenis tanaman berkualitas tinggi yang dapat
                            memuaskan konsumen kami. Bagi kami, kualitas adalah tradisi di kios kami, dan kami berkomitmen
                            untuk memberikan yang terbaik.</p>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4 mb-4">
                                <div class="contact-info-box mt-5">
                                    <h5 class="mb-2">WhatsApp</h5>
                                    <p class="mb-3">Hubungi kami dengan cepat dan mudah melalui WhatsApp.</p>
                                    <a href="https://wa.me/082231460094" target="_blank"
                                        class="btn btn-outline-secondary px-4 py-2">Hubungi Kami</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="contact-info-box mt-5">
                                    <h5 class="mb-2">Instagram</h5>
                                    <p class="mb-3">Ikuti kami di Instagram untuk update terbaru.</p>
                                    <a href="https://www.instagram.com/ciliwungplantshop" target="_blank"
                                        class="btn btn-outline-secondary px-4 py-2">Follow Us</a>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="contact-info-box mt-5">
                                    <h5 class="mb-2">Alamat</h5>
                                    <p class="mb-3">Jalan Ciliwung no 4, Lokasi Toko kami.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center bg-light py-3">
                        <p class="mb-0 text-muted">
                            Kami akan segera merespon pertanyaan Anda. Jangan ragu untuk menghubungi kami!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
