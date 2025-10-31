<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="/asset/icon.png" sizes="32x32" />
    <title>{{ $pageTitle }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FullCalendar v5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />

    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        #calendar {
            max-width: 1080px;
            margin: 0 auto;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
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
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <div id="loading" class="loading-screen">
        <div class="spinner"></div>
    </div>
    <div id="content">
        <div class="container">
            <h2 class="mb-4 text-center">Kalender Booking Bimbingan</h2>
            <div id="calendar"></div>
        </div>
    </div>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FullCalendar v5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            // Data event dari backend Laravel
            var bookings = @json($events);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
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
</body>

</html>
