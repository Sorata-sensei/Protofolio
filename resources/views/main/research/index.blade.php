@extends('main.template.index')
@push('css')
    <style>
        .research-secondary {
            font-size: 1rem !important;
            text-align: center !important;
            margin-top: 10px;
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

        .animated-line-journal {
            width: 15%;
            /* Panjang garis, atur sesuai kebutuhan */
            height: 4px;
            background: #000000;
            margin: 0;
            /* Tidak ada margin, garis tetap di kiri */
            transform: scaleX(0);
            transform-origin: left;
            animation: line-animation 0.7s ease-out forwards;
        }

        .animated-line-skripsi {
            width: 15%;
            /* Panjang garis, atur sesuai kebutuhan */
            height: 4px;
            background: #000000;
            margin: 0;
            /* Tidak ada margin, garis tetap di kiri */
            transform: scaleX(0);
            transform-origin: left;
            animation: line-animation 0.7s ease-out forwards;
        }

        .animated-line-tesis {
            width: 10%;
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

        .container-journal {
            margin: 20px 0;
            /* overflow: scroll; */
            /* max-height: 120px; */
        }

        .item {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .item .title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            /* Hitam ke abu-abuan */
            margin-bottom: 5px;
        }

        .item .authors {
            font-size: 14px;
            color: #555;
        }

        .item .journal {
            font-size: 14px;
            color: #777;
            font-style: italic;
        }

        .item .year {
            font-size: 14px;
            color: #777;
        }

        .title-journal {
            font-size: 1.5rem !important;
            font-weight: bold;
            text-align: left;
            margin-bottom: 5px;
        }

        .icon-bottom-profil {
            height: 100% !important;
            width: 170px !important;
        }

        @media (max-width: 480px) {
            .container {
                padding-top: 3rem !important;
            }
        }

        .link a {
            text-decoration: none !important;
            color: #000000;
            font-weight: bold;
        }

        .link a:hover {
            text-decoration: none !important;
            color: #4a4545;
        }
    </style>
@endpush
@section('content')
    <div class="container text-center pt-5">
        <div class="row justify-content-center">
            <h1 class="pt-5"><b>Penelitian</b></h1>
            <div class="animated-line"></div>
            <p class="research-secondary">Selamat datang di halaman yang menampilkan hasil penelitian terkini dalam bidang
                pengembangan web dan
                teknologi. Berfokus pada inovasi dan penerapan teknologi mutakhir, halaman ini menyajikan berbagai riset
                dan temuan yang relevan untuk menjawab tantangan di dunia digital.</p>
            <div class="col-xl-5 col-lg-5 col-md-5 col-12  profile">
                <p class="title-journal">Jurnal</p>
                <div class="animated-line-journal"></div>
                <div class="container-journal">
                    @foreach ($researches as $research)
                        <div class="item">
                            <div class="title">{{ $research->title }}</div>
                            <div class="authors">{{ $research->formattedAuthors() }}</div>
                            <div class="journal">{{ $research->journal }}</div>
                            <div class="year">{{ $research->year }}</div>
                            <div class="year">{{ $research->publisher }}</div>
                            <div class="link"><a href="{{ $research->journal_link }}" target="_blank">Lihat Jurnal</a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-12" style="text-align: left">
                <p class="title-journal">Skripsi</p>
                <div class="animated-line-skripsi mb-3"></div>
                <p>Implementasi E-Katalog 3D Berbasis Website Sebagai Sarana Promosi Barang Elektronik</p>
                <p class="title-journal">Tesis</p>
                <div class="animated-line-tesis mb-3"></div>
                <p>AUDIT APLIKASI PENCARI KERJA DENGAN TOGAF 9.2 <br>
                    (Studi Kasus: Dinas Tenaga Kerja Dan Transmigrasi Kabupaten Bantul)
                </p>
            </div>
        </div>
        <a href="https://scholar.google.com/citations?user=TQW_tWMAAAAJ&hl=en&authuser=2" target="_blank">
            <img src="/asset/scholar_icon.png" class="icon-bottom-profil">
        </a>
    </div>
@endsection
@push('scripts')
@endpush
