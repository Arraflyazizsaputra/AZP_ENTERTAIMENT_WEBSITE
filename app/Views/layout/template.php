<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> | AZP STUDIO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&family=Montserrat:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --azp-yellow: #FFD700;
            --azp-dark: #000000;
            --azp-white: #ffffff;
            --font-heading: 'Oswald', sans-serif;
            --font-body: 'Montserrat', sans-serif;
            --transition-yg: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        body {
            background-color: var(--azp-white);
            color: var(--azp-dark);
            font-family: var(--font-body);
            overflow-x: hidden;
        }

        /* --- ADVANCED NAVIGATION --- */
        .navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            z-index: 1050;
            background: transparent;
            padding: 25px 0;
            transition: var(--transition-yg);
            border-bottom: 1px solid transparent;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            padding: 15px 0;
            border-bottom: 1px solid #eeeeee;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand img {
            height: 45px;
            /* Ukuran Logo Navbar */
            width: auto;
            transition: var(--transition-luxe);
        }

        .nav-link {
            font-family: var(--font-heading);
            color: var(--azp-dark) !important;
            font-weight: 500;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 20px;
            position: relative;
            padding: 5px 0 !important;
            opacity: 1;
        }

        .nav-link:hover,
        .nav-link.active {
            opacity: 1;
            color: var(--azp-gold) !important;
        }

        /* Efek Garis Bawah YG saat Hover */
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--azp-dark);
            transition: var(--transition-yg);
        }

        /* Management Button Styling */
        .btn-management {
            background: var(--azp-dark);
            color: var(--azp-white) !important;
            font-family: var(--font-heading);
            border-radius: 0;
            /* YG jarang menggunakan rounded yang terlalu bulat */
            padding: 10px 30px !important;
            font-weight: 500;
            letter-spacing: 2px;
            transition: var(--transition-yg);
        }

        .btn-management:hover {
            background: var(--azp-yellow);
            color: var(--azp-dark) !important;
            transform: none;
            /* Menghilangkan efek melayang agar lebih solid */
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        /* --- MAIN AREA --- */
        main {
            min-height: 80vh;
        }

        /* --- PREMIUM FOOTER --- */
        footer {

            color: var(--azp-white);

            position: relative;
            overflow: hidden;
            background-color: #000000;
            padding: 80px 0 40px;
        }

        /* Logo Footer */
        .footer-logo-img {
            height: 60px;
            /* Ukuran Logo Footer */
            width: auto;
            margin-bottom: 30px;
            filter: brightness(0) invert(1);
            /* Membuat logo jadi putih di footer hitam */

        }

        .footer-tagline {
            color: #999;
            font-size: 0.95rem;
            line-height: 1.8;
            max-width: 350px;
            margin-bottom: 40px;
        }

        .footer-heading {
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 35px;
            color: var(--azp-yellow);
            font-family: var(--font-heading);
            font-size: 1.2rem;
            letter-spacing: 2px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 18px;
        }

        .footer-links a {
            color: #777;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition-luxe);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-links a:hover {
            color: var(--azp-white);
            padding-left: 0;
        }

        .contact-box {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 25px;
            color: #aaa;
        }

        .contact-box i {
            color: var(--azp-yellow);
            font-size: 1.4rem;
        }

        .social-circle-container {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }

        .social-circle {
            width: 50px;
            height: 50px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--azp-white);
            font-size: 1.4rem;
            transition: var(--transition-luxe);
            text-decoration: none;
        }

        .social-circle:hover {
            background: var(--azp-yellow);
            color: var(--azp-dark);
            border-color: var(--azp-yellow);
            transform: scale(1.1) rotate(10deg);
        }

        .footer-bottom {
            margin-top: 100px;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-bottom-text {
            font-size: 0.7rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 700;
            font-family: var(--font-heading);
            color: #333;
        }

        /* --- RESPONSIVE FIXES --- */
        @media (max-width: 991px) {
            .navbar-collapse {
                background: white;
                padding: 40px;
                border-radius: 30px;
                margin-top: 20px;
                box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
            }

            .btn-management {
                margin-top: 20px;
                width: 100%;
                text-align: center;
            }

            footer {
                text-align: center;
            }

            .contact-box {
                justify-content: center;
            }

            .social-circle-container {
                justify-content: center;
            }
        }

        .navbar-toggler {
            border: none;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/'); ?>">
                <img src="<?= base_url('img/logo.png'); ?>" alt="AZP STUDIO LOGO">
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class='bx bx-menu-alt-right fs-1'></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('/')) ? 'active' : ''; ?>" href="<?= base_url('/'); ?>">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('artists*')) ? 'active' : ''; ?>" href="<?= base_url('/artists'); ?>">Artists</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('about')) ? 'active' : ''; ?>" href="<?= base_url('about'); ?>">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('gallery*')) ? 'active' : ''; ?>" href="<?= base_url('/gallery'); ?>">Gallery</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('auditions*')) ? 'active' : ''; ?>" href="<?= base_url('/auditions'); ?>">Auditions</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('contact*')) ? 'active' : ''; ?>" href="<?= base_url('/contact'); ?>">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= url_is('opportunities') ? 'active' : ''; ?>" href="<?= base_url('opportunities'); ?>">
                            OPPORTUNITIES
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content'); ?>
    </main>

<footer style="border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img src="<?= base_url('img/lOGO.png'); ?>" class="footer-logo-img" alt="AZP STUDIO LOGO">
                    <p class="footer-tagline" style="text-align: justify; font-size: 0.85rem; color: #888;">
                        <strong>AZP Studio Entertainment</strong> (Founder: Arrafly Aziz Saputra) merupakan entitas agensi kreatif global yang berfokus pada manajemen talenta, produksi musik, dan pengembangan karir Artist, Group Band, hingga Aktor profesional untuk bersaing di kancah internasional.
                    </p>
                    <div class="social-circle-container">
                        <a href="https://www.instagram.com/arrxfinly_a_s_?igsh=MTRndnJ1eDR0anZwdg==" target="_blank" class="social-circle" title="Instagram"><i class='bx bxl-instagram'></i></a>
                        <a href="https://youtube.com/@arraflyaziz2?si=Ndf18NPfEzl48GAl" target="_blank" class="social-circle" title="YouTube"><i class='bx bxl-youtube'></i></a>
                        <a href="https://open.spotify.com/user/31otpy7htclwrlrgs5ukzm3tkejq?si=52f515a9aeba4431" target="_blank" class="social-circle" title="Spotify"><i class='bx bxl-spotify'></i></a>
                        <a href="https://www.tiktok.com/@flyking_bee?_r=1&_t=ZS-92lZ0PAnAcp" target="_blank" class="social-circle" title="TikTok"><i class='bx bxl-tiktok'></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 mb-4 mb-lg-0">
                    <h5 class="footer-heading" style="color: var(--azp-yellow); font-size: 0.9rem;">RELATIONS</h5>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('/'); ?>">Main Hub</a></li>
                        <li><a href="<?= base_url('artists'); ?>">Artist Roster</a></li>
                        <li><a href="<?= base_url('gallery'); ?>">Visual Archive</a></li>
                        <li><a href="<?= base_url('about'); ?>">Agency Profile</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 mb-4 mb-lg-0">
                    <h5 class="footer-heading" style="color: var(--azp-yellow); font-size: 0.9rem;">CONNECT</h5>
                    <ul class="footer-links">
                        <li><a href="<?= base_url('auditions'); ?>">Global Audition</a></li>
                        <li><a href="<?= base_url('opportunities'); ?>">Partnership</a></li>
                        <li><a href="<?= base_url('opportunities'); ?>">Careers</a></li>
                        <li><a href="<?= base_url('contact'); ?>">Business Inquiry</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-4">
                    <h5 class="footer-heading" style="color: var(--azp-yellow); font-size: 0.9rem;">HEADQUARTERS</h5>
                    <div class="contact-box mb-3">
                        <i class='bx bx-map-alt' style="color: var(--azp-yellow);"></i>
                        <span style="font-size: 0.85rem;">ANGGARNU CITY, Blok Sukasari<br>Pamanukan, Subang, Jawa Barat.</span>
                    </div>
                    <div class="contact-box mb-3">
                        <i class='bx bx-phone-call' style="color: var(--azp-yellow);"></i>
                        <span style="font-size: 0.85rem;">+62 821-2129-1219</span>
                    </div>
                    <div class="contact-box">
                        <i class='bx bx-envelope' style="color: var(--azp-yellow);"></i>
                        <span style="font-size: 0.85rem;">email_arraflyaziz@gmail.com</span>
                    </div>
                </div>
            </div>

           <div class="footer-bottom mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="footer-bottom-text m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #ffffff; text-transform: uppercase;">
                    &copy; <?= date('Y'); ?> <strong>AZP STUDIO ENTERTAINMENT</strong>. 
                    DIBUAT OLEH ARRAFLY AZIZ SAPUTRA DENGAN SEMANGAT YANG MEMBARA.
                </p>
                
                <div style="font-size: 50px; margin-top: 10px; display: block;">
                    &#128545;
                </div>
            </div>
        </div>
    </div>
</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Effect on Scroll
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>


</body>

</html>