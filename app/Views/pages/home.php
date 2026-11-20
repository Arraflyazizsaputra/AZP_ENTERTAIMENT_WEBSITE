<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700;900&family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    :root {
        --azp-yellow: #FFD700;
        --azp-dark: #111111;
        --azp-white: #ffffff;
        --azp-grey: #f8f8f8;
        --azp-muted: #666666;
        --transition-luxe: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        --font-primary: 'Montserrat', sans-serif;
        --font-heading: 'Oswald', sans-serif;
    }

    body {
        font-family: var(--font-primary);
        background-color: var(--azp-white);
        color: var(--azp-dark);
        overflow-x: hidden;
    }

    /* --- SCROLL ANIMATIONS --- */
    .scroll-animate {
        opacity: 0;
        transform: translateY(60px);
        transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scroll-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .scroll-animate.delay-1 {
        transition-delay: 0.1s;
    }

    .scroll-animate.delay-2 {
        transition-delay: 0.2s;
    }

    .scroll-animate.delay-3 {
        transition-delay: 0.3s;
    }

    .scroll-animate.delay-4 {
        transition-delay: 0.4s;
    }

    .scroll-animate.delay-5 {
        transition-delay: 0.5s;
    }

    .scroll-animate-left {
        opacity: 0;
        transform: translateX(-60px);
        transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scroll-animate-right {
        opacity: 0;
        transform: translateX(60px);
        transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scroll-animate-left.visible,
    .scroll-animate-right.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .scroll-animate-scale {
        opacity: 0;
        transform: scale(0.9);
        transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .scroll-animate-scale.visible {
        opacity: 1;
        transform: scale(1);
    }

    /* --- HERO SECTION --- */
    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 120px 0 200px;
        background-color: var(--azp-white);
        overflow: visible;

    }

    .diagonal-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 110%;
        z-index: 0;
        background-color: var(--azp-yellow);
        clip-path: polygon(0 0, 65% 0, 45% 100%, 0 100%);
        pointer-events: none;
    }

    .hero-title {
        font-family: var(--font-heading) !important;
        /* Paksa menggunakan Oswald */
        font-size: clamp(4rem, 12vw, 9rem);
        font-weight: 700;
        line-height: 0.9;
        margin-bottom: 35px;
        color: var(--azp-dark);
        text-transform: uppercase;
        letter-spacing: -1px;
        /* Oswald butuh spacing sedikit rapat */
        position: relative;
        z-index: 2;
    }

    .hero-title span {
        color: transparent;
        -webkit-text-stroke: 1.5px var(--azp-dark);
        font-style: normal;
        /* YG jarang menggunakan Italic untuk headline jangkung */
        font-family: var(--font-primary) !important;
        font-size: 0.95rem;
        /* Montserrat terlihat besar, ukuran dikecilkan agar elegan */
        letter-spacing: 0.5px;
        font-weight: 400;
    }

    .hero-desc {
        font-family: 'Outfit', sans-serif;
        font-size: 1.1rem;
        color: var(--azp-dark);
        max-width: 480px;
        line-height: 1.8;
        font-weight: 400;
        letter-spacing: 0.5px;
        border-left: 3px solid var(--azp-dark);
        padding-left: 25px;
        margin-bottom: 40px;
        position: relative;
        z-index: 2;
    }

    .hero-actions {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .btn-luxe-primary {
        background: var(--azp-dark);
        color: var(--azp-white);
        padding: 18px 40px;
        border-radius: 100px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition-luxe);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: var(--font-primary);
        letter-spacing: 3px;
        /* Spacing lebar pada tombol khas agensi Korea */
    }

    .btn-luxe-primary:hover {
        background: var(--azp-white);
        color: var(--azp-dark);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-luxe-link {
        color: var(--azp-dark);
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 0.85rem;
        border-bottom: 2px solid var(--azp-dark);
        padding-bottom: 5px;
        transition: 0.3s;
        font-family: var(--font-primary);
        letter-spacing: 3px;
        /* Spacing lebar pada tombol khas agensi Korea */
    }

    .btn-luxe-link:hover {
        opacity: 0.6;
    }

    .hero-image-wrapper {
        position: relative;
        z-index: 5;
        display: inline-block;
        margin-left: auto;
        transform: translateX(100px);
        transition: var(--transition-luxe);
    }

    .hero-img-main {
        width: 100%;
        max-width: 400px;
        position: relative;
        z-index: 2;
        border: 12px solid var(--azp-white);
        outline: 3px solid var(--azp-yellow);
        border-radius: 45px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.18);
        animation: heroFloat 6s ease-in-out infinite;
        left: 50px;
    }

    .hero-shape-decor {
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, var(--azp-yellow) 0%, transparent 70%);
        bottom: -5%;
        right: -10%;
        z-index: 0;
        filter: blur(80px);
        opacity: 0.3;
    }

    @keyframes heroFloat {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-25px);
        }
    }

    /* --- RUNNING TEXT SECTION --- */
    .running-text-section {
        position: relative;
        background: var(--azp-white);
        padding: 0;
        margin: 0;
        overflow: hidden;
        min-height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .running-line-1,
    .running-line-2,
    .running-line-3 {
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .running-line-1 {
        height: 100px;
        background: linear-gradient(90deg,
                rgba(255, 215, 0, 0.1) 0%,
                rgba(255, 215, 0, 0.05) 50%,
                rgba(255, 215, 0, 0.1) 100%);
    }

    .running-line-2 {
        height: 90px;
        background: var(--azp-dark);
    }

    .running-line-3 {
        height: 90px;
        background: linear-gradient(90deg,
                rgba(17, 17, 17, 0.03) 0%,
                rgba(17, 17, 17, 0.01) 50%,
                rgba(17, 17, 17, 0.03) 100%);
    }

    .running-text-1,
    .running-text-2,
    .running-text-3 {
        display: flex;
        white-space: nowrap;
    }

    .running-text-1 {
        animation: marqueeLine1 40s linear infinite;
    }

    .running-text-2 {
        animation: marqueeLine2 35s linear infinite;
    }

    .running-text-3 {
        animation: marqueeLine3 45s linear infinite;
    }

    .running-text-1 span,
    .running-text-2 span,
    .running-text-3 span {
        display: inline-flex;
        align-items: center;
        padding: 0 40px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .running-text-1 span {
        color: transparent;
        -webkit-text-stroke: 1.5px var(--azp-dark);
        letter-spacing: 2px;
        font-family: var(--font-heading) !important;
        font-size: 4rem;
        font-style: normal;
        font-weight: 700;
    }

    .running-text-1 span:hover {
        color: var(--azp-dark);
        -webkit-text-stroke: 0;
        transform: scale(1.05);
    }

    .running-text-1 span::after {
        content: "✧";
        color: var(--azp-yellow);
        font-size: 2rem;
        margin-left: 40px;
        opacity: 0.8;
    }

    .running-text-2 span {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--azp-white);
        opacity: 0.9;
        font-family: var(--font-primary) !important;
        letter-spacing: 8px;
    }

    .running-text-2 span:hover {
        color: var(--azp-yellow);
        opacity: 1;
        transform: translateY(-3px);
    }

    .running-text-2 span::before {
        content: "♪";
        color: var(--azp-yellow);
        font-size: 1.8rem;
        margin-right: 20px;
        opacity: 0.7;
    }

    .running-text-3 span {
        font-family: 'Outfit', sans-serif;
        font-size: 2.2rem;
        font-weight: 600;
        color: var(--azp-muted);
        letter-spacing: 2px;
        opacity: 0.7;
    }

    .running-text-3 span:hover {
        color: var(--azp-dark);
        opacity: 1;
        transform: scale(1.05);
    }

    .running-text-3 span::before {
        content: "★";
        color: var(--azp-yellow);
        font-size: 1.2rem;
        margin-right: 15px;
        opacity: 0.5;
    }

    @keyframes marqueeLine1 {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    @keyframes marqueeLine2 {
        0% {
            transform: translateX(-50%);
        }

        100% {
            transform: translateX(0);
        }
    }

    @keyframes marqueeLine3 {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .running-line-1:hover .running-text-1,
    .running-line-2:hover .running-text-2,
    .running-line-3:hover .running-text-3 {
        animation-play-state: paused;
    }

    /* --- ARTIST SHOWCASE --- */
    .artist-showcase-section {
        padding: 80px 0;
        background-color: #000000;
        overflow: hidden;
    }

    .premium-title-wrapper {
        position: relative;
        padding-bottom: 15px;
    }

    .premium-title-wrapper h4 {
        text-transform: uppercase;
        text-shadow: 0px 0px 8px rgba(255, 193, 7, 0.3);
    }

    .premium-title-wrapper h2 {
        color: #ffffff;
        position: relative;
        display: inline-block;
        font-family: var(--font-heading);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .premium-title-wrapper h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 4px;
        background-color: var(--azp-yellow);
        border-radius: 2px;
    }

    /* Menghilangkan jeda easing pada wrapper Swiper */
    .swiper-clean-artist .swiper-wrapper {
        transition-timing-function: linear !important;
        margin: 0 auto;
    }

    .artist-clean-card {
        background: transparent;
        transition: transform 0.4s ease;
    }

    .img-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 3/4;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .artist-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(20%);
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .card-action-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-explore-clean {
        background: #fff;
        color: #000;
        border: none;
        padding: 12px 25px;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border-radius: 50px;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .artist-clean-card:hover .artist-img {
        transform: scale(1.08);
        filter: grayscale(0%);
    }

    .artist-clean-card:hover .card-action-overlay {
        opacity: 1;
    }

    .artist-clean-card:hover .btn-explore-clean {
        transform: translateY(0);
    }

    .artist-info-clean .name {
        font-weight: 700;
        color: #fff;
        margin: 0;
        font-family: var(--font-heading) !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.6rem;
    }

    .artist-info-clean .category {
        font-size: 0.75rem;
        color: var(--azp-yellow);
        opacity: 0.8;
        margin-top: 5px;
        font-family: var(--font-primary);
        letter-spacing: 4px;
        /* Spacing lebar pada label */
        font-weight: 700;
    }

    /* --- YG FAMILY STYLE SECTION --- */
    .album-yg-section {
        background-color: #ffd000ff;
        padding: 100px 0;
        overflow: hidden;
    }

    .yg-label-wrapper {
        text-align: center;
        margin-bottom: 60px;
    }

    .yg-label {
        color: #000000;
        font-size: 1.4rem;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        padding-bottom: 15px;
        text-transform: uppercase;
        font-family: var(--font-primary);
        letter-spacing: 15px;
        /* Spacing extra lebar khas branding YG */
        font-weight: 400;
    }

    .swiper-album-yg {
        padding-top: 30px;
        padding-bottom: 90px;
        width: 100%;
    }

    .swiper-album-yg .swiper-slide {
        width: 550px;
        height: 550px;
        transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .album-card {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: #1a1a1a;

    }

    .album-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.2s ease;
    }

    .swiper-slide-active .album-card:hover img {
        transform: scale(1.1);
    }

    .album-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, transparent 100%);
        display: flex;
        align-items: flex-end;
        padding: 40px;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
        pointer-events: none;
    }

    .swiper-slide-active .album-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .yg-artist {
        color: #ff0000;
        display: block;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 5px;
        text-transform: uppercase;
        font-family: var(--font-primary);
        letter-spacing: 5px;

    }

    .yg-title {
        color: #fff;
        margin: 0;
        line-height: 1.1;
        font-family: var(--font-heading) !important;
        font-size: 2.8rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .yg-nav-btn {
        color: #fff !important;
        transition: 0.3s;
    }

    .yg-nav-btn:hover {
        color: #ff0000 !important;
        transform: scale(1.2);
    }

    .album-link-wrapper {
        display: block;
        cursor: pointer;
    }

    .album-card:active {
        transform: scale(0.98);
        /* Efek membal saat diklik */
        transition: transform 0.1s;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 992px) {
        .swiper-album-yg .swiper-slide {
            width: 400px;
            height: 400px;
        }

        .hero-section {
            text-align: center;
            padding-top: 150px;
        }

        .hero-image-wrapper {
            transform: translateX(0);
            margin-top: 50px;
        }

        .hero-desc {
            border-left: none;
            padding-left: 0;
            margin: 0 auto 40px;
        }

        .hero-title {
            font-size: 4rem;
        }

        .hero-actions {
            justify-content: center;
            flex-direction: column;
        }

        .running-line-1,
        .running-line-2,
        .running-line-3 {
            height: 70px;
        }

        .running-text-1 span {
            font-size: 2.2rem;
        }

        .running-text-2 span {
            font-size: 1.8rem;
        }

        .running-text-3 span {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 768px) {
        .swiper-album-yg .swiper-slide {
            width: 280px;
            height: 280px;
        }

        .running-line-1 {
            height: 60px;
        }

        .running-line-2,
        .running-line-3 {
            height: 50px;
        }

        .running-text-1 span {
            font-size: 1.8rem;
        }

        .running-text-2 span {
            font-size: 1.4rem;
        }

        .running-text-3 span {
            font-size: 1.1rem;
        }

        .running-text-1 span::after,
        .running-text-2 span::before,
        .running-text-3 span::before {
            display: none;
        }

        .yg-label {
            font-size: 1rem;
            letter-spacing: 5px;
        }
    }

    @media (max-width: 576px) {
        .swiper-album-yg .swiper-slide {
            width: 280px;
            height: 280px;
        }
    }
</style>

<section class="hero-section">
    <div class="diagonal-bg"></div>
    <div class="container hero-text-content">
        <div class="row align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="d-flex align-items-center gap-3 mb-4 scroll-animate delay-1">
                    <div style="width: 40px; height: 2px; background: var(--azp-dark);"></div>
                    <span class="fw-bold small letter-spacing-lg">AZP STUDIO &bull; Entertaiment</span>
                </div>
                <h1 class="hero-title scroll-animate delay-2">AZPcorp.<br><span>Ent.</span></h1>
                <p class="hero-desc mb-5 scroll-animate delay-3">Mendobrak batas musik konvensional dengan harmoni masa depan. Jadilah saksi evolusi talenta global di bawah naungan AZP Studio Ent.</p>
                <div class="d-flex align-items-center gap-4 scroll-animate delay-4">
                    <a href="/artists/soloist" class="btn-luxe-primary">EXPLORE ARTIST</a>
                    <a href="#daftar-album" class="btn-luxe-link">LATEST RELEASES</a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-image-column">
                <div class="hero-image-wrapper scroll-animate-scale delay-5">
                    <img src="<?= base_url('img/albums/fotomy.jpg'); ?>" alt="Kevin" class="hero-img-main">
                    <div class="hero-shape-decor"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RUNNING TEXT -->
<section class="running-text-section scroll-animate">
    <?php
    $i = 1;
    foreach ($running_texts as $line) :
        $items = explode(',', $line['content']);
    ?>
        <div class="running-line-<?= $i; ?>">
            <div class="running-text-<?= $i; ?>">
                <?php
                foreach ($items as $item) :
                    echo "<span>" . trim($item) . "</span>";
                endforeach;
                foreach ($items as $item) :
                    echo "<span>" . trim($item) . "</span>";
                endforeach;
                ?>
            </div>
        </div>
    <?php
        $i++;
    endforeach;
    ?>
</section>

<!-- ARTIST SHOWCASE -->
<section class="artist-showcase-section">
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-end scroll-animate">
            <div class="premium-title-wrapper">
                <h4 class="fw-bold mb-1" style="color: var(--azp-yellow); letter-spacing: 2px;">DAFTAR</h4>
                <h2 class="display-5 fw-bold m-0">SUPER STAR</h2>
            </div>
            <div class="swiper-nav-group d-none d-md-flex">
                <div class="swiper-button-prev-custom me-2"><i class="fas fa-chevron-left"></i></div>
                <div class="swiper-button-next-custom"><i class="fas fa-chevron-right"></i></div>
            </div>
        </div>
    </div>

    <div class="swiper swiper-clean-artist scroll-animate-scale delay-1">
        <div class="swiper-wrapper">
            <?php
            $temp_artists = $featured_artists;
            if (count($temp_artists) > 0) {
                while (count($temp_artists) < 12) {
                    $temp_artists = array_merge($temp_artists, $featured_artists);
                }
            }
            foreach ($temp_artists as $artist) :
            ?>
                <div class="swiper-slide">
                    <div class="artist-clean-card">
                        <div class="img-wrapper">
                            <img src="<?= base_url('img/artists/' . $artist['photo']); ?>" class="artist-img" alt="<?= $artist['name']; ?>">
                            <div class="card-action-overlay">
                                <button onclick="window.location.href='<?= base_url('artist/profile/' . $artist['id']); ?>'"
                                    class="btn-explore-clean">
                                    VIEW PROFILE
                                </button>
                            </div>
                        </div>
                        <div class="artist-info-clean">
                            <h3 class="name"><?= esc($artist['name']); ?></h3>
                            <p class="category text-uppercase"><?= esc($artist['category'] ?? 'Professional Talent'); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ALBUM SECTION -->
<section class="album-yg-section">
    <div id="daftar-album" class="container-fluid">
        <div class="yg-label-wrapper scroll-animate">
            <span class="yg-label">NEW RELEASE</span>
        </div>

        <div class="swiper swiper-album-yg scroll-animate-scale delay-1">
            <div class="swiper-wrapper">
                <?php if (!empty($albums)) : ?>
                    <?php foreach ($albums as $row) : ?>
                        <div class="swiper-slide">
                            <a href="<?= !empty($row['album_link']) ? $row['album_link'] : 'javascript:void(0)'; ?>"
                                target="<?= !empty($row['album_link']) ? '_blank' : '_self'; ?>"
                                class="album-link-wrapper" style="text-decoration: none;">

                                <div class="album-card">
                                    <div class="album-img-box">
                                        <img src="<?= base_url('img/albums/' . $row['image_path']); ?>" alt="<?= esc($row['title']); ?>">
                                        <div class="album-overlay">
                                            <div class="album-info">
                                                <span class="yg-artist"><?= esc($row['artist_name']); ?></span>
                                                <h2 class="yg-title"><?= esc($row['title']); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="swiper-button-next yg-next"></div>
            <div class="swiper-button-prev yg-prev"></div>
            <div class="swiper-pagination yg-pagination"></div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Swiper for artist showcase
    var swiperClean = new Swiper(".swiper-clean-artist", {
        slidesPerView: 1.5,
        spaceBetween: 20,
        centeredSlides: false,
        loop: true,
        speed: 5000, // Kecepatan gerak (ms), sesuaikan untuk kelancaran
        allowTouchMove: false,
        // --- KUNCI UTAMA UNTUK MENGHILANGKAN JEDA ---
        freeMode: true,
        cssMode: false,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        // Menghilangkan efek 'snap' atau tertahan saat transisi
        momentum: false,
        // --------------------------------------------
        breakpoints: {
            576: {
                slidesPerView: 2.2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3.2,
                spaceBetween: 30,
            },
            1200: {
                slidesPerView: 4.5,
                spaceBetween: 40,
            }
        }
    });

    // Initialize Swiper for album YG
    var swiperYG = new Swiper(".swiper-album-yg", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        loop: true,
        speed: 1000,
        touchRatio: 1.5,
        threshold: 5,
        resistanceRatio: 0.85,
        coverflowEffect: {
            rotate: 15,
            stretch: 0,
            depth: 200,
            modifier: 1,
            slideShadows: true,
        },
        autoplay: {
            delay: 800,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        mousewheel: {
            forceToAxis: true,
        },
        navigation: {
            nextEl: ".yg-next",
            prevEl: ".yg-prev",
        },
        pagination: {
            el: ".yg-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        keyboard: {
            enabled: true,
        },
    });

    // Scroll Animation Observer
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, entry.target.classList.contains('delay-1') ? 100 :
                        entry.target.classList.contains('delay-2') ? 200 :
                        entry.target.classList.contains('delay-3') ? 300 :
                        entry.target.classList.contains('delay-4') ? 400 :
                        entry.target.classList.contains('delay-5') ? 500 : 0);

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale').forEach(function(element) {
            observer.observe(element);
        });

        setTimeout(() => {
            document.querySelectorAll('.hero-section .scroll-animate, .hero-section .scroll-animate-scale').forEach(function(el) {
                el.classList.add('visible');
            });
        }, 300);
    });
</script>

<?= $this->endSection(); ?>