<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/asset/icon.png" sizes="32x32" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    @import url('https://fonts.cdnfonts.com/css/pixelify-sans');

    body {
        font-family: 'Pixelify Sans', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        background-color: #FFFFF0;
    }

    h1 {
        font-size: 5.5rem;
        color: #FA87A3;
    }

    .card {
        border: none !important;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">@yield('code')</h1>
                        <p class="text-center text-muted">@yield('message')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
