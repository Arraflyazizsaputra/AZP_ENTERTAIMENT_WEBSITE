<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($artist['name']); ?> | Official Profile</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700;900&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        :root {
            --gold-subtle: #bfa67a;
            --soft-white: #fcfcfc;
            --deep-charcoal: #1a1a1a;
            --border-color: rgba(0, 0, 0, 0.08);
            --transition-smooth: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--soft-white);
            color: var(--deep-charcoal);
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* NAVIGATION HEADER */
        .nav-header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 40px 5%;
            z-index: 1200;
            display: flex;
            justify-content: flex-end;
            pointer-events: none;
        }

        .lux-exit-btn {
            pointer-events: auto;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 30px;
            background: #fff;
            border: 1px solid var(--border-color);
            text-decoration: none;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            color: #000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            transition: var(--transition-smooth);
        }

        .lux-exit-btn:hover {
            background: #000;
            color: #fff;
            transform: translateY(-3px);
        }

        /* HERO SECTION */
        .grand-hero {
            height: 100vh;
            width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #000;
        }

        .hero-frame {
            position: absolute;
            inset: 0;
        }

        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 20%;
            opacity: 0.9;
        }

        .hero-vignette {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2) 0%, transparent 40%, var(--soft-white) 98%);
        }

        .hero-context {
            position: relative;
            z-index: 10;
            text-align: center;
            color: #fff;
        }

        .artist-display-name {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(4rem, 15vw, 12rem);
            margin: 10px 0;
            font-weight: 700;
            line-height: 0.85;
            text-transform: uppercase;
            letter-spacing: -2px;
        }

        .artist-divider {
            width: 80px;
            height: 4px;
            background: var(--gold-subtle);
            margin: 0 auto 25px;
        }

        .artist-category-text {
            font-size: 0.85rem;
            letter-spacing: 12px;
            font-weight: 300;
            opacity: 0.9;
        }

        /* CONTENT CONTAINER */
        .content-canvas {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 5%;
        }

        /* SECTION TITLES */
        .heading-title {
            font-family: 'Oswald', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 40px;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .heading-title::before {
            content: '';
            width: 40px;
            height: 2px;
            background: var(--gold-subtle);
        }

        /* BIO SECTION */
        .narrative-section {
            padding: 150px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .bio-outer-container {
            /* Meningkatkan max-width agar teks lebih lebar (dari 900px ke 1200px atau sesuai canvas) */
            max-width: 1300px;
            margin-left: 0;
            /* Tetap menempel di kiri */
            margin-right: auto;
            width: 100%;
            /* Memberikan sedikit padding agar tidak benar-benar menyentuh batas layar pada monitor tertentu */
            padding-right: 5%;
        }

        .bio-inner-text {
            font-size: 1.2rem;
            line-height: 1.8;
            /* Sedikit dirapatkan agar kepadatan teks terasa lebih kuat */
            color: #000000;
            text-align: justify;
            text-justify: inter-word;
            word-break: break-word;
            overflow-wrap: anywhere;
            font-weight: 400;
            /* Memberikan spasi antar huruf yang sangat tipis khas estetika YG */
            letter-spacing: 0.01em;
        }

        /* Memastikan Judul tetap sejajar dengan awal teks */
        .narrative-section .heading-title {
            margin-bottom: 50px;
            font-size: 2.5rem;
            letter-spacing: 3px;
        }

        /* WORKS SECTION */
        .works-section {
            padding: 150px 0;
        }

        .flex-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
        }

        .flex-heading .heading-title {
            margin-bottom: 0;
        }

        .grand-swiper-nav {
            display: flex;
            gap: 15px;
        }

        .nav-arrow {
            width: 70px;
            height: 70px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-smooth);
            background: #fff;
            font-size: 1.8rem;
        }

        .nav-arrow:hover {
            background: #000;
            color: #fff;
            border-color: #000;
        }

        .work-card {
            transition: var(--transition-smooth);
            position: relative;
        }

        .work-img-container {
            position: relative;
            aspect-ratio: 6/6;
            overflow: hidden;
            background: #eee;
        }

        .work-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .work-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition-smooth);
            backdrop-filter: blur(5px);
        }

        .work-card:hover .work-overlay {
            opacity: 1;
        }

        .work-card:hover img {
            transform: scale(1.1);
        }

        .view-txt {
            color: #fff;
            font-size: 0.7rem;
            letter-spacing: 4px;
            font-weight: 700;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
        }

        .work-details {
            padding-top: 25px;
        }

        .work-title {
            font-family: 'Oswald', sans-serif;
            font-size: 1.2rem;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* DIGITAL FOOTPRINT */
        .digital-section {
            padding: 100px 0 150px;
        }

        .social-grid {
            display: grid;
            /* Optimasi: Membuat kolom otomatis ke samping selama ruang mencukupi */
            /* minmax 250px memastikan item tidak terlalu gepeng */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .social-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 35px;
            /* Sedikit dikurangi agar lebih compact ke samping */
            border: 1px solid var(--border-color);
            text-decoration: none;
            color: inherit;
            transition: var(--transition-smooth);
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .social-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--gold-subtle);
            transform: scaleY(0);
            transition: var(--transition-smooth);
        }

        .social-item:hover {
            background: #000;
            color: #fff;
            transform: translateY(-8px);
        }

        .social-item:hover::before {
            transform: scaleY(1);
        }

        .soc-label {
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 3px;
            white-space: nowrap;
        }

        .soc-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: var(--transition-smooth);
        }

        .social-item:hover .soc-circle {
            border-color: rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .nav-header {
                padding: 30px 5%;
            }

            .heading-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .nav-header {
                padding: 20px;
                justify-content: center;
            }

            .lux-exit-btn {
                width: 100%;
                justify-content: center;
            }

            .artist-display-name {
                font-size: 4.5rem;
            }

            .narrative-section,
            .works-section {
                padding: 80px 0;
            }

            .social-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="nav-header">
        <a href="javascript:history.back()" class="lux-exit-btn">
            <i class='bx bx-x'></i>
            <span>BACK</span>
        </a>
    </div>

    <section class="grand-hero">
        <div class="hero-frame">
            <?php if (!empty($artist['photo'])): ?>
                <img src="<?= base_url('img/artists/' . $artist['photo']); ?>" alt="<?= esc($artist['name']); ?>" class="hero-img">
            <?php else: ?>
                <img src="<?= base_url('img/no-photo.jpg'); ?>" class="hero-img">
            <?php endif; ?>
            <div class="hero-vignette"></div>
        </div>

        <div class="hero-context">
            <div class="hero-text-wrap">
                <span class="artist-status">PROFILE ARTIST</span>
                <h1 class="artist-display-name"><?= esc($artist['name']); ?></h1>
                <div class="artist-divider"></div>
                <p class="artist-category-text"><?= strtoupper(esc($artist['category'] ?? 'Musician & Performer')); ?></p>
            </div>
        </div>
    </section>

    <div class="content-canvas">

        <section class="narrative-section" id="bio">
            <div class="heading-title">BIOGRAPHY</div>
            <div class="bio-outer-container">
                <div class="bio-inner-text">
                    <?= !empty($artist['description']) ? nl2br(esc($artist['description'])) : 'Description currently being updated.'; ?>
                </div>
            </div>
        </section>

        <section class="works-section">
            <div class="flex-heading">
                <div class="heading-title">DISCOGRAPHY</div>
                <div class="grand-swiper-nav d-none d-md-flex">
                    <div class="nav-arrow prev-work"><i class='bx bx-chevron-left'></i></div>
                    <div class="nav-arrow next-work"><i class='bx bx-chevron-right'></i></div>
                </div>
            </div>

            <div class="swiper workSwiper">
                <div class="swiper-wrapper">
                    <?php if (!empty($albums)): foreach ($albums as $album): ?>
                            <div class="swiper-slide">
                                <div class="work-card">
                                    <a href="<?= esc($album['youtube_url']); ?>" target="_blank" style="text-decoration:none; color:inherit;">
                                        <div class="work-img-container">
                                            <img src="<?= base_url('img/discography/' . $album['album_cover']); ?>" alt="<?= esc($album['album_title']); ?>">
                                            <div class="work-overlay">
                                                <span class="view-txt">ALBUMS</span>
                                            </div>
                                        </div>
                                        <div class="work-details">
                                            <h4 class="work-title"><?= esc($album['album_title']); ?></h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach;
                    else: ?>
                        <p>No works listed yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="digital-section">
            <div class="heading-title">DIGITAL MEDIA</div>
            <div class="social-grid">

                <?php if (!empty($artist['x_link'])): ?>
                    <a href="<?= esc($artist['x_link']); ?>" target="_blank" class="social-item">
                        <span class="soc-label">X / TWITTER</span>
                        <div class="soc-circle"><i class='bx bxl-twitter'></i></div>
                    </a>
                <?php endif; ?>

                <?php if (!empty($artist['ig_link'])): ?>
                    <a href="<?= esc($artist['ig_link']); ?>" target="_blank" class="social-item">
                        <span class="soc-label">INSTAGRAM</span>
                        <div class="soc-circle"><i class='bx bxl-instagram'></i></div>
                    </a>
                <?php endif; ?>

                <?php if (!empty($artist['tiktok_link'])): ?>
                    <a href="<?= esc($artist['tiktok_link']); ?>" target="_blank" class="social-item">
                        <span class="soc-label">TIKTOK</span>
                        <div class="soc-circle"><i class='bx bxl-tiktok'></i></div>
                    </a>
                <?php endif; ?>

                <?php if (!empty($artist['fb_link'])): ?>
                    <a href="<?= esc($artist['fb_link']); ?>" target="_blank" class="social-item">
                        <span class="soc-label">FACEBOOK</span>
                        <div class="soc-circle"><i class='bx bxl-facebook'></i></div>
                    </a>
                <?php endif; ?>

            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Swiper tetap aktif untuk fungsionalitas slider
            new Swiper('.workSwiper', {
                slidesPerView: 1.2,
                spaceBetween: 30,
                speed: 1000,
                loop: true,
                grabCursor: true,
                navigation: {
                    nextEl: '.next-work',
                    prevEl: '.prev-work'
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2.5
                    },
                    1200: {
                        slidesPerView: 3.5
                    }
                }
            });
        });
    </script>
</body>

</html>