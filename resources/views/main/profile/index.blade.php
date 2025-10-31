@extends('main.template.index')
@push('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            padding-top: 45px !important;
        }

        .profile-text {
            font-size: 1rem !important;
            text-align: justify !important;
            margin: 30px 10px 10px 30px;
        }

        .profile {
            display: flex;
            justify-content: center;
            /* Horizontal center */
            align-items: center;
            /* Vertical center */

            /* Optional: untuk memastikan container mengambil seluruh tinggi layar */
        }

        .profile-img {
            width: 100%;
            height: auto;
            /* Menjaga rasio gambar */
            max-height: 700px;
            /* Menyediakan batasan tinggi jika perlu */
            object-fit: contain;
            /* Menjaga proporsi gambar tanpa mengubahnya */
            min-width: 500px;
        }

        .title-profile {
            font-size: 1.5rem !important;
            font-weight: bold;
            text-align: left;
        }


        .animated-text {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .animated-line {
            width: 29%;
            /* Panjang garis, atur sesuai kebutuhan */
            height: 4px;
            background: #000000;
            margin: 0;
            /* Tidak ada margin, garis tetap di kiri */
            transform: scaleX(0);
            transform-origin: left;
            animation: line-animation 0.7s ease-out forwards;
        }

        @keyframes line-animation {
            0% {
                transform: scaleX(0);
            }

            100% {
                transform: scaleX(1);
            }
        }

        .pdf-img {
            width: 50px;
            /* Sesuaikan ukuran */
            height: 50px;
            /* Sesuaikan ukuran */
            margin-right: 8px;
            /* Jarak antara ikon dan teks */
            vertical-align: middle;
        }

        .text-pdf {
            text-decoration: none;
            color: #000000;
            /* Warna teks, sesuaikan */
            font-family: Arial, sans-serif;
            /* Font teks */
            font-size: 16px;
            /* Ukuran teks */
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .text-pdf:hover {
            color: #302f2e;
            /* Warna teks saat hover */
        }

        @media (max-width: 480px) {
            .profile-img {
                width: 100%;
                height: auto;
                /* Menjaga rasio gambar */
                max-height: 400px;
                /* Menyediakan batasan tinggi jika perlu */
                object-fit: contain;
                /* Menjaga proporsi gambar tanpa mengubahnya */
                min-width: 200px;
            }


            .profile-text {
                margin: 0px !important;
            }
        }

        @media (max-width: 375px) {}

        @media (max-width: 480px) {
            .container {
                padding-top: 3rem !important;
            }
        }

        .logo {
            width: 50px;
            height: 50px;
        }

        .pendidikan {
            display: flex;
            margin-top: 15px;
        }
    </style>
@endpush
@section('content')
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-5 col-md-5 col-12">
                <div>
                    <p class="title-profile pt-5">Tentang Saya</p>
                    <div class="animated-line"></div>
                    <p class="profile-text">Saya adalah seorang programmer web yang berdedikasi
                        dengan pengalaman lebih dari 3 tahun dalam
                        pengembangan web. Selama karier saya, saya telah berhasil
                        merancang, mengembangkan, dan memelihara berbagai
                        aplikasi web yang inovatif dan efisien. Dengan latar belakang
                        yang kuat dalam teknologi web dan pemrograman, saya
                        memiliki kemampuan untuk menerjemahkan kebutuhan bisnis
                        menjadi solusi teknologi yang efektif.</p>
                    <a href="{{ $url }}" download class="text-pdf animate-left">
                        <img src="/asset/icon_download_pdf.png" alt="Download PDF" class="pdf-img ">
                        Download Curriculum Vitae
                    </a>
                </div>
                <div>
                    <p class="title-profile pt-3">Pendidikan</p>
                    <div class="animated-line"></div>
                    <div class="pendidikan">
                        <img src="/asset/akprind_icon.png" alt="akprind" class="logo">
                        <div class="px-2" style="text-align: left">
                            <p style="margin: 0px !important;"><b>Universitas AKPRIND Yogyakarta</b></p>
                            <p style="margin: 0px !important;">Informatika <b>3,52</b> </p>
                            <p style="margin: 0px !important;">S1(Strata-1)</p>
                        </div>
                    </div>
                    <div class="pendidikan">
                        <img src="/asset/amikom_icon.png" alt="akprind" class="logo">
                        <div class="px-2" style="text-align: left">
                            <p style="margin: 0px !important;"><b>Universitas Amikom Yogyakarta</b></p>
                            <p style="margin: 0px !important;">Digital Transformation Intelligence <b>3,73</b> </p>
                            <p style="margin: 0px !important;">S2(Strata-2)</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-12 profile">
                <img src="/asset/anwarfb.png" alt="Hero Image" class="img-fluid profile-img animate-right">
            </div>

        </div>
    </div>
@endsection

@push('scripts')
@endpush
