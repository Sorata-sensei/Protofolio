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
        <div class="container-lg mt-5">
            <div class="row">


                <div class="col-6 p-4 shadow">
                    <div class="container my-4">
                        <h3 class="mb-4 text-center">Booking Bimbingan</h3>
                        <form id="formBimbingan" class="mx-auto" style="max-width: 1600px;">
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
                                                aria-describedby="iconJam" required min="08:30" max="14:00" step="300">
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
                <div class="col-6">

                    nanti kalendar disini

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
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var bookings = [{
                id: '1',
                title: 'Skripsi - Budi (NIM: 123456)',
                start: '2025-05-20T10:00:00',
                end: '2025-05-20T11:00:00',
                description: 'Pembahasan Bab 1'
            },
            {
                id: '2',
                title: 'Tugas Akhir - Sari (NIM: 098765)',
                start: '2025-05-21T14:00:00',
                end: '2025-05-21T15:00:00',
                description: 'Revisi Metodologi'
            },
            {
                id: '3',
                title: 'Konsultasi Umum - Andi (NIM: 112233)',
                start: '2025-05-22T09:00:00',
                end: '2025-05-22T09:30:00',
                description: 'Diskusi Jadwal dan Rencana'
            },
            {
                id: '4',
                title: 'Skripsi - Rina (NIM: 445566)',
                start: '2025-05-23T13:00:00',
                end: '2025-05-23T14:00:00',
                description: 'Pembahasan Bab 2'
            },
            {
                id: '5',
                title: 'Tugas Akhir - Dedi (NIM: 778899)',
                start: '2025-05-24T08:30:00',
                end: '2025-05-24T09:30:00',
                description: 'Diskusi Metodologi'
            }
        ];

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            navLinks: true,
            nowIndicator: true,
            events: bookings,
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            },
            eventDidMount: function(info) {
                if (info.event.extendedProps.description) {
                    new bootstrap.Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            }
        });

        calendar.render();
    });
    </script>

    <script>
    const dateInput = document.getElementById('tanggalBimbingan');
    const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    const alertModalBody = document.getElementById('alertModalBody');

    // Format tanggal ke yyyy-mm-dd
    function formatDate(date) {
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Set min dan max tanggal (hari ini sampai 1 bulan ke depan)
    const today = new Date();
    const minDate = formatDate(today);
    const maxDateObj = new Date(today);
    maxDateObj.setMonth(maxDateObj.getMonth() + 1);
    const maxDate = formatDate(maxDateObj);

    dateInput.min = minDate;
    dateInput.max = maxDate;

    let holidays = [];

    // Ambil data hari libur Indonesia dari API Nager.Date
    async function fetchHolidays(year, countryCode) {
        try {
            const response = await fetch(`https://date.nager.at/api/v3/PublicHolidays/${year}/${countryCode}`);
            if (!response.ok) throw new Error('Gagal mengambil data hari libur');
            const data = await response.json();
            holidays = data.map(holiday => holiday.date); // array tanggal libur dalam format yyyy-mm-dd
        } catch (error) {
            console.error('Error fetching holidays:', error);
            holidays = [];
        }
    }

    // Cek apakah tanggal adalah Sabtu, Minggu, atau hari libur
    function isDateDisabled(date) {
        const day = date.getDay();
        const formatted = formatDate(date);
        if (day === 0 || day === 6) return true; // Minggu=0, Sabtu=6
        if (holidays.includes(formatted)) return true;
        return false;
    }

    // Tampilkan modal dengan pesan
    function showModal(message) {
        alertModalBody.textContent = message;
        alertModal.show();
    }

    // Validasi tanggal saat user memilih
    dateInput.addEventListener('input', function() {
        const selectedDate = new Date(this.value);
        if (isDateDisabled(selectedDate)) {
            showModal(
                'Oops! Tanggal yang kamu pilih jatuh pada hari Sabtu, Minggu, atau hari libur. Yuk, pilih tanggal lain supaya bimbingannya lancar ya! 😊'
            );
            this.value = '';
        }
    });

    // Inisialisasi: ambil hari libur untuk tahun ini dan negara Indonesia (ID)
    fetchHolidays(today.getFullYear(), 'ID');
    </script>

</body>

</html>