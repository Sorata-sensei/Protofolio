<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Muhammad Anwar Fauzi - Web Programmer & Lecturer</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <style>
        :root {
            --bg-color: #FFF8F0;
            --text-color: #2D2D2D;
            --accent: #E2725B;
            --accent-light: #FFD580;
            --section-bg: #FFF0E0;
        }

        body.dark {
            --bg-color: #1E1B18;
            --text-color: #F8EBD5;
            --accent: #E2725B;
            --accent-light: #FFB347;
            --section-bg: #2C241E;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
            transition: background 0.6s ease, color 0.6s ease;
        }

        nav.navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            transition: background 0.5s ease;
        }

        body.dark nav.navbar {
            background: rgba(30, 27, 24, 0.95);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--accent) !important;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--text-color) !important;
            font-weight: 500;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* === HERO SECTION === */
        #hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: white;
            position: relative;
            overflow: hidden;
            padding: 4rem 2rem;
        }

        .hero-content {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 3rem;
            z-index: 2;
        }

        .hero-text {
            flex: 1 1 400px;
        }

        .hero-text h1 {
            font-size: 3rem;
            font-weight: 700;
            opacity: 0;
        }

        .hero-text .subtitle {
            font-size: 1.4rem;
            margin: 1rem 0 2rem;
            min-height: 2rem;
        }

        .cta-btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: white;
            color: var(--accent);
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .hero-photo {
            flex: 1 1 350px;
            text-align: center;
            opacity: 0;
        }

        .hero-photo img {
            max-width: 90%;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transform: scale(0.95);
            transition: transform 0.6s ease;
        }

        .hero-photo img:hover {
            transform: scale(1.02);
        }

        section {
            padding: 5rem 2rem;
            background: var(--bg-color);
            scroll-margin-top: 90px;
            transition: background 0.6s ease;
        }

        #about,
        #research {
            background: var(--section-bg);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            position: relative;
            opacity: 0;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--accent-light));
            border-radius: 2px;
        }

        .skill-card,
        .activity-card,
        .research-item {
            background: white;
            color: var(--text-color);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: all 0.3s ease;
            opacity: 0;
            transform: scale(0.8);
        }

        body.dark .skill-card,
        body.dark .activity-card,
        body.dark .research-item {
            background: #2C241E;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        .activity-card:hover,
        .skill-card:hover {
            transform: translateY(-5px) scale(1);
        }

        /* === FOOTER === */
        footer {
            background: linear-gradient(90deg, var(--accent), var(--accent-light));
            color: white;
            text-align: center;
            padding: 3rem 1rem;
            margin-top: 5rem;

            overflow: hidden;
            position: relative;
            width: 100vw;
            left: 50%;
            transform: translateX(-50%);
        }

        footer p {
            font-size: 1rem;
            letter-spacing: 0.5px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 1rem 0 2rem;
        }

        .social-icons a {
            font-size: 1.6rem;
            color: white;
            opacity: 0;
            transition: transform 0.4s ease, color 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.3) rotate(10deg);
            color: #fff8e5;
        }

        #toTop {
            border-radius: 50px;
            font-weight: 600;
            color: var(--accent);
            background: white;
            transition: all 0.3s ease;
            padding: 0.6rem 1.4rem;
            border: none;
        }

        #toTop:hover {
            transform: translateY(-3px);
        }

        .dark-toggle {
            border: none;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            transition: all 0.3s;
        }

        .dark-toggle:hover {
            transform: rotate(20deg) scale(1.1);
        }

        /* Floating Bubbles */
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            pointer-events: none;
            animation: floatUp linear infinite;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateY(-120vh) scale(0.5);
                opacity: 0;
            }
        }

        /* ===== Activities Section ===== */
        #activities {
            background-color: #f8f9fa;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        .activity-card {
            background: #fff;
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.4s ease;
        }

        .activity-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* Image Wrapper: memastikan gambar proporsional */
        .image-wrapper {
            width: 100%;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eaeaea;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .activity-card:hover img {
            transform: scale(1.05);
        }

        .activity-card .card-title {
            font-weight: 600;
            color: #212529;
        }

        .activity-card .card-text {
            font-size: 0.95rem;
            color: #555;
        }

        .activity-card .read-more {
            font-weight: 500;
            color: #0a66c2;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .activity-card .read-more:hover {
            color: #084b8a;
        }

        /* ===== Dark Mode Support ===== */
        body.dark #activities {
            background-color: #121212;
            color: #eaeaea;
        }

        body.dark .activity-card {
            background: #1e1e1e;
            color: #eaeaea;
            box-shadow: 0 0 0 transparent;
        }

        body.dark .activity-card:hover {
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.05);
        }

        body.dark .card-text {
            color: #ccc;
        }

        body.dark .read-more {
            color: #4da3ff;
        }

        body.dark .read-more:hover {
            color: #80c0ff;
        }

        body.dark .card-title {
            color: #ffffff !important;
        }

        body.dark .card-footer {
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#hero">MAF</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activities">Activities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#research">Research</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-lg-3">
                        <button id="darkToggle" class="dark-toggle">🌙</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>Muhammad Anwar Fauzi</h1>
                <div class="subtitle" id="typewriter"></div>
                <a href="#about" class="cta-btn">Discover More</a>
            </div>
            <div class="hero-photo">
                <img src="https://anwarfauzi.my.id/asset/anwarfb.png" alt="Muhammad Anwar Fauzi">
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <p class="text-center mb-4">Web Programmer & Lecturer passionate about modern web technologies and
                education.</p>
            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-3">
                    <div class="skill-card">Laravel</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="skill-card">PWA</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="skill-card">JavaScript</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="skill-card">WordPress</div>
                </div>
            </div>
        </div>
    </section>

    <section id="activities" class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Recent Activities</h2>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="activity-card shadow-sm border-0 h-100">
                        <div class="image-wrapper">
                            <img src="https://picsum.photos/600/400" alt="Student Mentoring">
                        </div>
                        <div class="card-body p-4">
                            <h4 class="card-title mb-2">Student Mentoring</h4>
                            <p class="card-text">Helping students develop real-world web projects and improve
                                collaboration
                                skills.</p>
                            <a href="#" class="read-more">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        <div class="card-footer text-muted small px-4 pb-3">
                            <i class="far fa-calendar-alt me-1"></i> October 2025
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="activity-card shadow-sm border-0 h-100">
                        <div class="image-wrapper">
                            <img src="https://picsum.photos/500/700" alt="Internal App Dev">
                        </div>
                        <div class="card-body p-4">
                            <h4 class="card-title mb-2">Internal App Dev</h4>
                            <p class="card-text">Building Laravel-based campus applications to support digital
                                transformation.</p>
                            <a href="#" class="read-more">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        <div class="card-footer text-muted small px-4 pb-3">
                            <i class="far fa-calendar-alt me-1"></i> September 2025
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="activity-card shadow-sm border-0 h-100">
                        <div class="image-wrapper">
                            <img src="https://picsum.photos/800/300" alt="Conference Talks">
                        </div>
                        <div class="card-body p-4">
                            <h4 class="card-title mb-2">Conference Talks</h4>
                            <p class="card-text">Sharing insights on educational technology and web programming
                                innovation.
                            </p>
                            <a href="#" class="read-more">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                        <div class="card-footer text-muted small px-4 pb-3">
                            <i class="far fa-calendar-alt me-1"></i> August 2025
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="research">
        <div class="container">
            <h2 class="section-title">Research Publications</h2>
            <div class="research-item mb-3">
                <h4>Optimizing Web App Performance Using Caching</h4>
                <p>2023</p>
            </div>
            <div class="research-item mb-3">
                <h4>The Role of PWA in Education</h4>
                <p>2024</p>
            </div>
            <div class="research-item">
                <h4>API-Driven Development for Scalable Systems</h4>
                <p>2025</p>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container text-center">
            <h2 class="section-title">Get In Touch</h2>
            <p>Interested in collaboration or have questions? Let’s connect!</p>
            <a href="mailto:anwar@example.com" class="btn btn-lg btn-primary mt-3"
                style="border-radius:50px;background:var(--accent);border:none;">📩 Send Email</a>
        </div>
    </section>

    <footer>
        <div class=" pb-3 mb-3">
            <p class="mb-2">© 2025 <strong>Muhammad Anwar Fauzi</strong> — Made with ❤️ using Anime.js & Bootstrap
            </p>
            <div class="social-icons mb-3">
                <a href="https://github.com/anwarfauzi" target="_blank" title="GitHub"><i
                        class="fab fa-github"></i></a>
                <a href="https://linkedin.com/in/anwarfauzi" target="_blank" title="LinkedIn"><i
                        class="fab fa-linkedin"></i></a>
                <a href="mailto:anwar@example.com" title="Email"><i class="fas fa-envelope"></i></a>
            </div>
            <button id="toTop" class="btn btn-outline-light">
                <i class="fas fa-arrow-up"></i> Back to Top
            </button>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // HERO ANIMATIONS
        anime({
            targets: '.hero-text h1',
            opacity: [0, 1],
            translateY: [50, 0],
            duration: 1200,
            easing: 'easeOutExpo'
        });
        const text = "Web Programmer & Lecturer";
        const el = document.getElementById('typewriter');
        let i = 0;
        (function type() {
            if (i < text.length) {
                el.textContent += text.charAt(i++);
                setTimeout(type, 100);
            }
        })();
        anime({
            targets: '.cta-btn',
            opacity: [0, 1],
            translateY: [30, 0],
            delay: 2500,
            duration: 1000,
            easing: 'easeOutExpo'
        });
        anime({
            targets: '.hero-photo',
            opacity: [0, 1],
            scale: [0.9, 1],
            delay: 1800,
            duration: 1200,
            easing: 'easeOutElastic(1, .7)'
        });

        // SCROLL ANIMATIONS
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    anime({
                        targets: entry.target,
                        opacity: [0, 1],
                        translateY: [50, 0],
                        scale: [0.8, 1],
                        duration: 800,
                        easing: 'easeOutExpo'
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2
        });

        document.querySelectorAll('.section-title, .skill-card, .activity-card, .research-item')
            .forEach(el => observer.observe(el));

        // FOOTER ANIMATIONS
        const footer = document.querySelector('footer');
        const footerIcons = footer.querySelectorAll('.social-icons a');
        const footerObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // anime({ targets: footer, translateY: [100, 0], opacity: [0, 1], duration: 1000, easing: 'easeOutExpo' });
                    anime({
                        targets: footerIcons,
                        opacity: [0, 1],
                        translateY: [30, 0],
                        delay: anime.stagger(200),
                        duration: 800,
                        easing: 'easeOutBack'
                    });
                    footerObserver.unobserve(footer);
                }
            });
        }, {
            threshold: 0.2
        });
        footerObserver.observe(footer);

        // BACK TO TOP BUTTON
        document.getElementById('toTop').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // BUBBLE BACKGROUND
        const bubbleCount = 15;
        for (let i = 0; i < bubbleCount; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('bubble');
            const size = Math.random() * 60 + 20;
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${Math.random() * 100}%`;
            bubble.style.bottom = `${-Math.random() * 100}px`;
            bubble.style.animationDuration = `${8 + Math.random() * 10}s`;
            bubble.style.animationDelay = `${Math.random() * 5}s`;
            document.body.appendChild(bubble);
        }

        // DARK MODE TOGGLE
        const toggle = document.getElementById('darkToggle');
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark' || (!currentTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.classList.add('dark');
            toggle.textContent = '☀️';
        }

        toggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            const newTheme = document.body.classList.contains('dark') ? 'dark' : 'light';
            localStorage.setItem('theme', newTheme);
            anime({
                targets: toggle,
                rotate: '1turn',
                duration: 600,
                easing: 'easeInOutSine'
            });
            toggle.textContent = newTheme === 'dark' ? '☀️' : '🌙';
        });
    </script>
</body>

</html>
