@extends('main.template.index')

@push('css')
    <style>
        .card {
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(4.9px);
            -webkit-backdrop-filter: blur(4.9px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.12);
            /* border-bottom-left-radius: 15px 255px;
                                            border-bottom-right-radius: 225px 15px;
                                            border-top-left-radius: 255px 15px;
                                            border-top-right-radius: 15px 225px; */
        }

        .badge-bestseller {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #28a745;
            /* Warna hijau */
            color: white;
            padding: 10px;
            transform: rotate(45deg);
            transform-origin: top right;
            width: 120px;
            /* Sesuaikan lebar badge */
            text-align: center;
            font-weight: bold;
        }

        .card-main::before {
            position: absolute;
            content: '';
            /* background: #283593; */
            height: 28px;
            width: 28px;
            /* Added lines */
            top: 2.3rem;
            right: -0.5rem;
            transform: rotate(45deg);
            z-index: -1;

        }

        .card-main::after {
            position: absolute;
            content: attr(data-content);
            top: 11px;
            right: -14px;
            padding: 0.5rem;
            width: 10rem;
            /* background: #3949ab; */
            color: white;
            text-align: center;
            box-shadow: 4px 4px 15px rgba(26, 35, 126, 0.2);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            font-weight: bold;
            border-radius: 7px 0px 0px 7px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 1px;
        }

        .popup {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black w/ opacity */
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-footer {
            border-top: none;
        }

        .modal-header {
            border-bottom: none;
        }

        h5 {
            text-align: center;
            font-weight: bold;
            margin-top: 0;
            font-size: 4vw;
            /* Responsive font size based on viewport width */
        }

        .modal {
            --bs-modal-width: 1000px;
        }

        .img-activity {

            width: 100%;
            /* Atur lebar sesuai kebutuhan, misalnya 300px untuk tampilan kotak */

            overflow: hidden;
            /* Menghindari gambar keluar dari kontainer */
            /* border-radius: 10px; */
            /* Membuat sudut kontainer menjadi melengkung */
            /* border: 2px solid; */

        }

        .img-activity img {
            width: 100%;
            /* Atur lebar gambar */
            height: 100%;
            /* Atur tinggi gambar agar sesuai dengan kontainer */
            object-fit: contain;

            /* Membuat gambar menutupi seluruh kontainer */

        }

        .date-time {
            font-size: 0.7rem !important;
        }

        a {

            /* Warna untuk tombol lihat selengkapnya */
            cursor: pointer;
            color: #000000;
            text-decoration: none;
            font-weight: bold;

        }

        a:hover {

            /* Warna untuk tombol lihat selengkapnya */
            cursor: pointer;
            color: #3d3a38;

        }

        .no-more {
            color: #9381FF;
            font-weight: bold;
        }

        .badge-award::before,
        .badge-award::after {
            background: #FF9800;
            /* Oranye untuk Penghargaan */
        }

        .badge-qualification::before,
        .badge-qualification::after {
            background: #3F51B5;
            /* Biru tua untuk Kualifikasi */
        }

        .badge-seminar::before,
        .badge-seminar::after {
            background: #4CAF50;
            /* Hijau untuk Seminar */
        }

        .badge-workshop::before,
        .badge-workshop::after {
            background: #FFC107;
            /* Kuning untuk Workshop */
        }

        .badge-training::before,
        .badge-training::after {
            background: #9C27B0;
            /* Ungu untuk Pelatihan */
        }

        .badge-conference::before,
        .badge-conference::after {
            background: #FF5722;
            /* Oranye cerah untuk Konferensi */
        }

        .badge-graduation::before,
        .badge-graduation::after {
            background: #2196F3;
            /* Biru muda untuk Wisuda */
        }

        .badge-graduation-success::before,
        .badge-graduation-success::after {
            background: #8BC34A;
            /* Hijau limau untuk Kelulusan */
        }

        .badge-graduation-day::before,
        .badge-graduation-day::after {
            background: #00BCD4;
            /* Biru aqua untuk Graduasi */
        }

        .badge-new-job::before,
        .badge-new-job::after {
            background: #FF4081;
            /* Merah muda untuk Pekerjaan Baru */
        }

        .badge-career::before,
        .badge-career::after {
            background: #3F51B5;
            /* Biru tua untuk Karir */
        }

        .badge-job-vacancy::before,
        .badge-job-vacancy::after {
            background: #FFC107;
            /* Kuning untuk Lowongan Kerja */
        }

        .badge-certificate::before,
        .badge-certificate::after {
            background: #FFEB3B;
            /* Kuning untuk Sertifikat */
        }

        .badge-community-service::before,
        .badge-community-service::after {
            background: #4CAF50;
            /* Hijau untuk Abdimas */
        }

        .badge-haki::before,
        .badge-haki::after {
            background: #4caf9d;
            /* Hijau untuk Abdimas */
        }

        .badge-empty::before,
        .badge-empty::after {
            background: #4CAF50;
            /* Hijau untuk Abdimas */
        }
    </style>
    <style>
        /* CSS */
        .button-card {
            align-self: center;
            background-color: #ffffff;
            background-image: none;
            background-position: 0 90%;
            background-repeat: repeat no-repeat;
            background-size: 4px 3px;
            border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
            border-style: solid;
            border-width: 2px;
            box-sizing: border-box;
            color: #141414;
            cursor: pointer;
            display: inline-block;

            padding: .75rem;
            text-decoration: none;
            transition: all 235ms ease-in-out;
            border-bottom-left-radius: 15px 255px;
            border-bottom-right-radius: 225px 15px;
            border-top-left-radius: 255px 15px;
            border-top-right-radius: 15px 225px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            font-weight: bold;
        }

        .button-card:hover {
            box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;
            transform: translate3d(0, 2px, 0);
        }

        .button-card:focus {
            box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
        }

        .button-load {
            background-color: #000000;
            /* Warna latar belakang coklat tua */
            color: #FFFFF0;
            /* Warna teks putih krem */
            border: none;
            /* Tanpa border */
            border-radius: 5px;
            /* Sudut melengkung */
            padding: 10px 20px;
            /* Padding atas-bawah dan kiri-kanan */
            font-size: 16px;
            /* Ukuran font */
            cursor: pointer;
            /* Menunjukkan bahwa ini dapat diklik */
            transition: background-color 0.3s, transform 0.2s;
            /* Transisi untuk efek hover */
            display: inline-block;
            /* Menampilkan sebagai blok inline */
            position: relative;
            /* Mengatur posisi relatif */
            z-index: 10;
            /* Z-index lebih tinggi dari elemen lain */
            margin: 20px auto;
            /* Margin untuk menempatkan tombol di tengah */
            text-align: center;
            /* Memastikan teks di tengah */
        }

        .button-load:hover {
            background-color: #27272a;
            /* Warna latar belakang saat hover (coklat lebih terang) */
            transform: scale(1.05);
            color: #fff;
            /* Efek zoom saat hover */
        }

        .button-load:focus {
            outline: none;
            color: #fff;
            /* Menghilangkan outline saat tombol difokuskan */
        }

        .button-load:active {
            transform: scale(0.95);
            /* Efek zoom saat tombol ditekan */
        }
    </style>
@endpush

@section('content')
    @include('main.header.navbar')
    <div class="container pt-5">
        <header class="">
            <h1 class="text-center pt-5">Ringkasan Aktivitas Terbaru</h1>
            <p style="text-align: center">Selamat datang di halaman yang menyajikan ringkasan aktivitas terbaru dalam
                perjalanan
                karir saya. Di sini, Anda
                akan menemukan informasi terkini mengenai berbagai kegiatan yang telah saya lakukan, termasuk pencapaian,
                proyek
                yang sedang berjalan, dan inisiatif baru. Saya berharap ringkasan ini memberikan gambaran yang jelas tentang
                komitmen saya dalam mencapai tujuan dan mengembangkan diri.</p>
        </header>
        <div class="row" id="activity-container">
            @include('main.daily.partials', ['activities' => $activities])
        </div>

        <div class="text-center ">
            <button id="load-more" class="btn  button-load mb-5">Lihat Aktifitas Lain</button>
            <p id="no-more-data" class="no-more mb-5" style="display: none;">semua aktifitas sudah termuat</p>
            <!-- Pesan tidak ada data -->
        </div>


    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let page = 1; // Mulai dari halaman pertama
            $('#load-more').on('click', function() {
                page++;
                $.ajax({
                    url: '{{ route('main.index') }}?page=' + page,
                    type: 'GET',
                    success: function(data) {
                        if (data.trim() === "") {
                            $('#load-more')
                                .hide(); // Sembunyikan tombol jika tidak ada data lagi
                            $('#no-more-data').show(); // Tampilkan pesan tidak ada data
                        } else {
                            $('#activity-container').append(data);
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan. Silakan coba lagi nanti.');
                    }
                });
            });
        });
    </script>
@endpush
