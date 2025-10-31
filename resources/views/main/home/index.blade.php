@extends('main.template.index')
@push('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .typewriter {
            /* font-family: monospace; */


            margin-bottom: 5px;
        }

        .typewriter .active {
            border-right: 3px solid;
            /* Ukuran dan warna kursor */
            animation: blink-caret 0.7s step-end infinite;
        }

        @keyframes blink-caret {
            50% {
                border-color: transparent;
            }
        }

        /* Tombol yang tersembunyi dengan opacity 0 dan visibility hidden */
        #collaboration-button {
            opacity: 0;
            visibility: hidden;
            transition: opacity 1s ease-in-out, visibility 0s 1s;
            /* Transisi untuk opacity dan visibility */
        }

        /* Ketika tombol muncul dengan fade-in */
        .show {
            opacity: 1 !important;
            visibility: visible !important;
            transition: opacity 1s ease-in-out, visibility 0s 0s !important;
            /* Waktu transisi menjadi 0 setelah tombol muncul */
        }

        /* Hero Section */


        .hero-text {
            flex: 1;
            padding: 20px;
            text-align: left;
        }

        .hero-image {
            flex: 1;
            padding: 20px;
            order: 1;
            z-index: 1;
        }


        .hero h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.2rem;
        }



        /* Membuat gambar responsif */
        .hero-image img {
            width: 100%;
            height: auto;
            /* Menjaga rasio gambar */
            max-height: 500px;
            /* Menyediakan batasan tinggi jika perlu */
            object-fit: cover;
            /* Menjaga proporsi gambar tanpa mengubahnya */
            min-width: 500px;
        }

        .name-hero {
            font-size: 1.5rem !important;
            font-weight: bold;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
                /* Pastikan elemen tersusun vertikal */
                padding: 10px;
            }

            .hero-text {
                font-size: 16px;
                /* Ukuran teks lebih kecil */
                line-height: 1.5;
            }

            .hero-image {
                order: 2;
                /* Gambar berada di bawah teks */
                max-width: 100%;
                margin-top: 20px;
            }

            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .hero {
                margin-bottom: 9.1rem !important;
            }

            .hero .cta-button {
                padding: 10px 20px;
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero-image img {
                min-width: 300px !important;
            }

            .hero {
                display: grid !important;
                margin-bottom: 0.1rem !;
                padding: 0px !important;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .hero p {
                font-size: 0.9rem;
            }

            .hero-text {
                max-width: 100%;
                /* Hindari teks terlalu lebar */
                word-wrap: break-word;
                /* Pastikan kata panjang tidak keluar */
                text-align: left;
                /* Sesuaikan rata tengah */
                margin-bottom: 20px;
                /* Tambahkan jarak di bawah teks */
            }

            .hero .cta-button {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }

        .container {
            padding-top: 75px !important;
        }
    </style>
@endpush
@section('content')
    <div class="container text-center">
        <div class="row justify-content-center ">
            <div class="col-xl-7 col-lg-5 col-md-5 col-12 ">
                <div class="hero-text animate-left mx-auto mt-5">
                    <div class="typewriter" id="typewriter1">
                        <span id="typing-text-1" class="name-hero"></span>
                    </div>
                    <div class="typewriter" id="typewriter2">
                        <span id="typing-text-2"></span>
                    </div>
                    <div class="typewriter" id="typewriter3">
                        <span id="typing-text-3"></span>
                    </div>
                    <div class="typewriter pb-3" id="typewriter4">
                        <span id="typing-text-4"></span>
                    </div>


                    <a href="mailto:{{ $user->email }}" id="collaboration-button" class="button-main">
                        <span class="text"><i class="fa fa-envelope "></i>
                            Hubungi
                            Saya</span>
                    </a>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                <div class="hero-image">
                    <img src="/asset/anwar.png" alt="Hero Image" class="img-fluid animate-right">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const texts = [
            "Halo,",
            "Saya Muhammad Anwar Fauzi, S.Kom., M.Kom.,",
            "Konsultan Web kreatif dan inovatif",
            "Ingin berkolaborasi ?",
        ];

        const elements = [
            document.getElementById("typing-text-1"),
            document.getElementById("typing-text-2"),
            document.getElementById("typing-text-3"),
            document.getElementById("typing-text-4"),
        ];
        console.log("Elements initialized:", elements);
        let textIndex = 0;
        let charIndex = 0;

        function type() {
            // Tambahkan kelas active hanya ke elemen yang sedang aktif
            elements.forEach((element, index) => {
                if (index === textIndex) {
                    element.classList.add("active");
                } else {
                    element.classList.remove("active");
                }
            });

            // Proses pengetikan karakter per karakter
            if (charIndex < texts[textIndex].length) {
                elements[textIndex].innerHTML += texts[textIndex].charAt(charIndex);
                charIndex++;
                setTimeout(type, 100);
            } else if (textIndex < texts.length - 1) {
                // Jika kalimat selesai, lanjut ke kalimat berikutnya
                charIndex = 0;
                textIndex++;
                setTimeout(type, 2000);
            } else {
                // Setelah kalimat terakhir selesai, tampilkan tombol dengan animasi fade-in
                elements[textIndex].classList.add("active");

                // Tampilkan tombol dengan animasi fade-in
                const button = document.getElementById("collaboration-button");
                setTimeout(() => {
                    button.classList.add("show"); // Menambahkan kelas 'show' untuk memulai animasi fade-in
                }, 500); // Jeda sebelum tombol mulai muncul (setengah detik setelah kalimat selesai)
            }
        }

        // Mulai mengetik
        type();
    </script>
@endpush
