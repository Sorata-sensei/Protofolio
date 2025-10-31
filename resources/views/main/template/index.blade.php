<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="R-7NLQ0k7cdYqc2gbCYlI0Hxl-kwtrmlnbcqgw12UV0" />
    <link rel="icon" href="/asset/icon.png" sizes="32x32" />
    <title>{{ $pageTitle }}</title>
    @include('main.header.headerscriptorlink')
    @stack('css')

</head>

<body class="d-flex flex-column min-vh-100">
    <div id="loading" class="loading-screen">
        <div class="spinner"></div>
    </div>
    @include('main.header.navbar')

    <div id="content" style="display: none;">
        {{-- <button id="theme-toggle" onclick="toggleDarkMode()" class="popup-button"><i
                class="fa-regular fa-sun"></i></button> --}}
        <div class="container pb-5">

            @yield('content')
        </div>
    </div>
    @include('main.footer.footer')
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
</body>

</html>
