<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/asset/icon.png" sizes="32x32" />
    <title>{{ $pageTitle }}</title>
    @include('main.header.headerscriptorlink')
    @stack('css')
    <style>
        /* Full-screen loading background */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #FFF;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Pastikan z-index lebih tinggi dari elemen lain seperti navbar */
        }

        .loading-screen {
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .loading-screen.hide {
            opacity: 0;
            pointer-events: none;
        }

        /* Spinner animation */
        .spinner {
            width: 80px;
            height: 80px;
            --c: linear-gradient(#695CFF 0 0);
            background:
                var(--c) 0 0,
                var(--c) 0 100%,
                var(--c) 50% 0,
                var(--c) 50% 100%,
                var(--c) 100% 0,
                var(--c) 100% 100%;
            background-size: 16px 50%;
            background-repeat: no-repeat;
            animation: db7-0 1s infinite;
            position: relative;
            overflow: hidden;
        }

        .spinner:before {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #695CFF;
            top: calc(50% - 8px);
            left: -16px;
            animation: inherit;
            animation-name: db7-1;
        }

        @keyframes db7-0 {
            16.67% {
                background-size: 16px 30%, 16px 30%, 16px 50%, 16px 50%, 16px 50%, 16px 50%
            }

            33.33% {
                background-size: 16px 30%, 16px 30%, 16px 30%, 16px 30%, 16px 50%, 16px 50%
            }

            50% {
                background-size: 16px 30%, 16px 30%, 16px 30%, 16px 30%, 16px 30%, 16px 30%
            }

            66.67% {
                background-size: 16px 50%, 16px 50%, 16px 30%, 16px 30%, 16px 30%, 16px 30%
            }

            83.33% {
                background-size: 16px 50%, 16px 50%, 16px 50%, 16px 50%, 16px 30%, 16px 30%
            }
        }

        @keyframes db7-1 {
            20% {
                left: 0px
            }

            40% {
                left: calc(50% - 8px)
            }

            60% {
                left: calc(100% - 16px)
            }

            80%,
            100% {
                left: 100%
            }
        }



        @keyframes cube {
            from {
                transform: scale(0) rotate(0deg) translate(-50%, -50%);
                opacity: 1;
            }

            to {
                transform: scale(20) rotate(960deg) translate(-50%, -50%);
                opacity: 0;
            }
        }

        .background {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            margin: 0;
            padding: 0;
            overflow: hidden;
            z-index: -1;

        }

        .background li {
            position: absolute;
            top: 80vh;
            left: 45vw;
            width: 10px;
            height: 10px;
            border: solid 1px #aab3ee;
            color: transparent;
            border-radius: 2px;
            transform-origin: top left;
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
            animation: cube 17s ease-in forwards infinite;
        }

        .background li:nth-child(0) {
            animation-delay: 0s;
            left: 21vw;
            top: 50vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(1) {
            animation-delay: 2s;
            left: 96vw;
            top: 26vh;
        }

        .background li:nth-child(2) {
            animation-delay: 4s;
            left: 4vw;
            top: 76vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(3) {
            animation-delay: 6s;
            left: 91vw;
            top: 49vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(4) {
            animation-delay: 8s;
            left: 44vw;
            top: 37vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(5) {
            animation-delay: 10s;
            left: 74vw;
            top: 22vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(6) {
            animation-delay: 12s;
            left: 12vw;
            top: 1vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(7) {
            animation-delay: 14s;
            left: 39vw;
            top: 64vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(8) {
            animation-delay: 16s;
            left: 77vw;
            top: 10vh;
        }

        .background li:nth-child(9) {
            animation-delay: 18s;
            left: 55vw;
            top: 67vh;
        }

        .background li:nth-child(10) {
            animation-delay: 20s;
            left: 62vw;
            top: 96vh;
            border-color: #aab3ee;
        }

        .background li:nth-child(11) {
            animation-delay: 22s;
            left: 25vw;
            top: 88vh;
        }

        .toast-container {
            margin: 10px;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="loading" class="loading-screen">
        <div class="spinner"></div>
    </div>


    <div id="content" style="display: none;">
        <ul class="background">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <button id="theme-toggle" onclick="toggleDarkMode()" class="popup-button"><i
                class="fa-regular fa-sun"></i></button>
        @include('admin.message.index')
        <div class="container-lg mt-3">
            <h1 class="mb-4">Guidance Sessions Bookings</h1>
            <div class="row shadow">
                <div class="col-6 col-md-12 col-sm-12 p-4 ">
                    <div class="container my-4">
                        <form action="{{ route('main.store') }}" id="formBimbingan" class="mx-auto"
                            style="max-width: 1600px;" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="namaMahasiswa" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="namaMahasiswa" name="nama_mahasiswa"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim"
                                        placeholder="Masukkan NIM" required pattern="\d+"
                                        title="NIM harus berupa angka">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="jenisBimbingan" class="form-label">Jenis Bimbingan</label>
                                    <select class="form-select" id="jenisBimbingan" name="jenis_bimbingan" required>
                                        <option value="" selected disabled>Pilih jenis bimbingan</option>
                                        <option value="Skripsi">Skripsi</option>
                                        <option value="Tugas">Tugas</option>
                                        <option value="Tugas Akhir">Tugas Akhir</option>
                                        <option value="Konsultasi Umum">Konsultasi Umum</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="jam" class="form-label">Jam</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="iconJam">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 3.5a.5.5 0 0 1 .5.5v3.25l2.5 1.5a.5.5 0 0 1-.5.866l-2.75-1.65V4a.5.5 0 0 1 .5-.5z" />
                                                    <path
                                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14z" />
                                                </svg>
                                            </span>
                                            <input type="time" class="form-control" id="jam" name="jam"
                                                aria-describedby="iconJam" required min="08:30" max="14:00"
                                                step="300">
                                        </div>
                                        <div id="timeHelpBlock" class="form-text">
                                            Batas waktu bimbingan mulai dari 08.30 sampai 14.00
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="tanggalBimbingan" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggalBimbingan" name="tanggal"
                                        required>
                                </div>

                                <div class="col-12">
                                    <label for="catatan" class="form-label">Catatan / Topik Bimbingan
                                        (opsional)</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"
                                        placeholder="Tuliskan catatan atau topik bimbingan"></textarea>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary px-5">Booking Bimbingan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-6 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Jenis Bimbingan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $booking)
                                    <tr>
                                        <td>{{ $booking['id'] }}</td>
                                        <td>{{ $booking['nama_mahasiswa'] }}</td>
                                        <td>{{ $booking['nim'] }}</td>
                                        <td>{{ $booking['jenis_bimbingan'] }}</td>
                                        <td>{{ $booking['tanggal'] }}</td>
                                        <td>{{ $booking['jam'] }}</td>
                                        <td>{{ $booking['catatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination links -->
                        <div class="d-flex justify-content-left">
                            {{ $events->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="alertModalLabel">Peringatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="alertModalBody">
                    <!-- Pesan akan dimasukkan di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('main.footer.footerscriptorlink')
    @stack('scripts')
    <script>
        // Fungsi ini akan dijalankan setelah semua konten halaman (termasuk gambar, script, dll) selesai dimuat
        window.onload = () => {
            const loadingScreen = document.getElementById('loading');
            const content = document.getElementById('content');

            setTimeout(() => {
                loadingScreen.classList.add('hide');
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                    content.style.display = 'block';
                }, 500); // Tunggu transisi selesai
            }, 500);

        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEls = document.querySelectorAll('.toast');
            toastEls.forEach((toastEl, index) => {
                const delay = 5000 * (index + 1); // Delay toast 5 detik berturut-turut
                const toast = new bootstrap.Toast(toastEl, {
                    delay: delay
                });
                toast.show(); // Menampilkan toast
            });
        });
    </script>
</body>

</html>
