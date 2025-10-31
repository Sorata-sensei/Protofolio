@extends('main.template.index')

@push('css')
<style>
header h5 {
    text-align: center;
    font-weight: bold;
    margin-top: 0;
    font-size: 4vw;
    /* Responsive font size based on viewport width */
}

header p {
    text-align: center;
    margin-bottom: 5px;
    font-size: 2.5vw;
    /* Responsive font size based on viewport width */
}

.activity h2 {
    font-size: 3vw;
    /* Responsive font size for activity titles */
}

.description p {
    font-size: 2vw;
    /* Responsive font size for descriptions */
}

.activity-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: start;
    /* Menyebar item secara merata */
    margin: -10px;
    /* Menghilangkan margin untuk mengatur jarak */
}

.activity {

    line-height: 1.2rem;
    /* Warna latar belakang putih untuk card */
    border-radius: 15px;
    border: none !important;
    /* Sudut melengkung */
    padding: 10px;
    /* background-color: #fff; */
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    /* Padding di dalam card */
    margin-left: 10px;
    margin-right: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
    /* Margin di luar card */
    flex: 0 1 calc(25% - 20px);
    /* Mengatur lebar card menjadi 25% dengan margin */
    box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    /* Bayangan untuk efek kedalaman */
    transition: transform 0.2s;
    /* Efek transisi saat hover */
    display: flex;
    /* Menggunakan flexbox untuk mengatur konten */
    flex-direction: column;
    /* Mengatur arah konten menjadi kolom */
    overflow: hidden;
    /* Menghindari overflow */
    /* max-height: 690px !important; */
    width: 100%;
    height: 100%;
    /* filter: grayscale(100%); */
    max-width: 300px;
}

.activity:hover {
    transform: scale(1.05);
    filter: grayscale(0%);
    /* Efek zoom saat hover */
}

.activity:focus {
    transform: scale(1.05);
    filter: grayscale(0%);
}

.activity img {
    max-width: 100%;
    /* Memastikan gambar responsif */
    /* border-radius: 5px; */
    /* Sudut melengkung untuk gambar */
}

.description {
    overflow: hidden;
    /* Sembunyikan overflow */
    transition: max-height 0.3s ease;
    /* Transisi saat hover */
    flex-grow: 1;
    /* Membiarkan deskripsi tumbuh untuk mengisi ruang */
}

.full-description {
    display: none;
    /* Sembunyikan deskripsi penuh secara default */
}

.toggle-description {

    /* Warna untuk tombol lihat selengkapnya */
    cursor: pointer;
    color: #A77F5A;

}

.toggle-description:hover {

    /* Warna untuk tombol lihat selengkapnya */
    cursor: pointer;
    color: #7D4F29;

}

a {

    /* Warna untuk tombol lihat selengkapnya */
    cursor: pointer;
    color: #A77F5A;
    text-decoration: none;
    font-weight: bold;

}

a:hover {

    /* Warna untuk tombol lihat selengkapnya */
    cursor: pointer;
    color: #7D4F29;

}

.button-load {
    background-color: #7D4F29;
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
    background-color: #A65E3A;
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

.img-activity {
    width: 100%;
    /* Atur lebar sesuai kebutuhan, misalnya 300px untuk tampilan kotak */

    overflow: hidden;
    /* Menghindari gambar keluar dari kontainer */
    border-radius: 10px;
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


/* Media Queries for finer control on specific breakpoints */
@media (max-width: 768px) {
    .activity {
        flex: none !important;
    }

    header h5 {
        font-size: 5vw;
        /* Larger font size for smaller screens */
    }

    header p {
        font-size: 3vw;
        /* Larger font size for smaller screens */
    }

    .activity h2 {
        font-size: 4vw;
        /* Larger font size for smaller screens */
    }

    .description p {
        font-size: 2.5vw;
        /* Larger font size for smaller screens */
    }
}

@media (max-width: 480px) {
    header h5 {
        font-size: 6vw;
        /* Even larger font size for very small screens */
    }

    header p {
        font-size: 4vw;
        /* Even larger font size for very small screens */
    }

    .activity h2 {
        font-size: 5vw;
        /* Even larger font size for very small screens */
    }

    .activity {
        margin-top: 10px;
        margin-left: 0px !important;
        margin-right: 0px !important;
    }

    .description p {
        font-size: 3vw;
        /* Even larger font size for very small screens */
    }
}

.text-container {

    padding: 5px;
}

.text-header-container {}

.text-muted {
    font-size: 0.8rem !important;
    padding: 0px !important;
    margin: 0px !important;
}

.full-description {
    display: none;
    /* Sembunyikan deskripsi penuh secara default */
}
</style>
@endpush

@section('content')
@include('main.header.navbar')
<div class="container">
    <header class="pt-5">
        <h1 class="text-center pt-5">Ringkasan Aktivitas Terbaru</h1>
        <p style="text-align: center">Selamat datang di halaman yang menyajikan ringkasan aktivitas terbaru dalam
            perjalanan
            karir saya. Di sini, Anda
            akan menemukan informasi terkini mengenai berbagai kegiatan yang telah saya lakukan, termasuk pencapaian,
            proyek
            yang sedang berjalan, dan inisiatif baru. Saya berharap ringkasan ini memberikan gambaran yang jelas tentang
            komitmen saya dalam mencapai tujuan dan mengembangkan diri.</p>
    </header>
    <div class="activity-container">
        @foreach ($activities as $index => $activity)
        <div class="activity" style="{{ $index >= 4 ? 'display: none;' : '' }}">

            @if ($activity->image)
            <div class="img-activity">
                <img src="{{ asset('storage/images/' . $activity->image) }}" alt="{{ $activity->title }}">
            </div>
            @endif
            <div class="text-header-container">
                <h5 class="text-center text-capitalize pt-2 fw-bold" style="margin= 0px !important">
                    {{ $activity->title }}</h5>
            </div>
            <div class="text-container">
                @if (!empty($activity->description))
                <div class="description">
                    @if (strlen($activity->description) <= 200) <p class="short-description lh-sm"> {!!
                        $activity->description !!} </p>
                        @else
                        <p class="short-description lh-sm"> {!! Str::limit($activity->description, 200, '...') !!} </p>
                        <p class="full-description lh-sm" style="display: none;"> {!! $activity->description !!} </p>
                        <span class="toggle-description">Lihat Selengkapnya</span>
                        @endif
                </div>
                @endif
                <!--<p>Panjang deskripsi: {{ strlen($activity->description) }} karakter</p>-->
                <hr style="border: 1px solid #000; width: 100%; margin:6px 0px 6px 0px !important;" />

                <p class="text-muted">
                    {{ \Carbon\Carbon::parse($activity->date)->translatedFormat('l, d F Y') }}
                    <br>
                    ({{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }})
                </p>
            </div>
        </div>
        @endforeach
    </div>
    @if (count($activities) > 4)
    <button id="load-more" class="button-load btn " style="display: block; margin: 20px auto;">Lihat Aktivitas
        Lainnya</button>
    @endif
</div>
@endsection

@include('main.footer.footerscriptorlink')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Menambahkan event listener untuk tombol toggle deskripsi
    // Menambahkan event listener untuk tombol toggle deskripsi
    document.querySelectorAll('.toggle-description').forEach(button => {
        button.addEventListener('click', () => {
            const activity = button.closest(
                '.description'); // Mengambil elemen terdekat dengan kelas description
            const shortDescription = activity.querySelector('.short-description');
            const fullDescription = activity.querySelector('.full-description');

            // Menggunakan getComputedStyle untuk memeriksa apakah fullDescription ditampilkan
            const isFullDescriptionVisible = window.getComputedStyle(fullDescription)
                .display !== 'none';

            // Toggle visibility of the full description
            if (!isFullDescriptionVisible) {
                fullDescription.style.display = 'block'; // Show full description
                shortDescription.style.display = 'none'; // Hide short description
                button.textContent = 'Sembunyikan'; // Change button text
            } else {
                fullDescription.style.display = 'none'; // Hide full description
                shortDescription.style.display = 'block'; // Show short description
                button.textContent = 'Lihat Selengkapnya'; // Reset button text
            }
        });
    });

    // Fungsi untuk memuat semua aktivitas
    const loadMoreButton = document.getElementById('load-more');
    const activities = document.querySelectorAll('.activity');
    let currentActivityCount = 4; // Mulai dengan 4 aktivitas yang ditampilkan
    let isExpanded = false; // Melacak status ekspansi

    // Menyembunyikan semua aktivitas setelah 4
    activities.forEach((activity, index) => {
        if (index >= currentActivityCount) {
            activity.style.display = 'none'; // Sembunyikan aktivitas tambahan
        } else {
            activity.style.display = 'flex'; // Tampilkan aktivitas yang pertama
        }
    });

    loadMoreButton.addEventListener('click', () => {
        if (!isExpanded) {
            // Tampilkan semua aktivitas
            activities.forEach(activity => {
                activity.style.display = 'flex'; // Tampilkan semua aktivitas
            });
            loadMoreButton.textContent = 'Sembunyikan Aktivitas Lainnya'; // Ubah teks tombol
        } else {
            // Sembunyikan aktivitas tambahan dan kembali ke 4
            activities.forEach((activity, index) => {
                if (index >= currentActivityCount) {
                    activity.style.display = 'none'; // Sembunyikan aktivitas setelah 4
                }
            });
            loadMoreButton.textContent = 'Lihat Aktivitas Lainnya'; // Kembalikan teks tombol
        }
        isExpanded = !isExpanded; // Ubah status ekspansi
    });
});
</script>
@endpush