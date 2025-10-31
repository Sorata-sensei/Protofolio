<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/851cf73cb8.js" crossorigin="anonymous"></script>
<script src="/js/darkmode.js"></script>
<script src="/js/nav.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/main.css') }}">
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/button.css') }}">
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/nav.css') }}">
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/font.css') }}">
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/img.css') }}">
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/animations.css') }}">
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/body.css') }}">
<link id="theme-stylesheet" rel="stylesheet" href="{{ url('/css/footer.css') }}">
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
        --c: linear-gradient(#000000 0 0);
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
        background: #8E2940;
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
