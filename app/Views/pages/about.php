<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700;900&family=Oswald:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    :root {
        --yg-black: #000000;
        --yg-dark: #111111;
        --yg-grey: #f8f8f8;
        --yg-light: #f5f5f5;
        --azp-gold: #FFD700;
        --azp-gold-light: #FFF9C4;
        --transition-smooth: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        --yg-font-main: 'Montserrat', sans-serif;
        --yg-font-title: 'Oswald', sans-serif;
    }

    body {
        font-family: var(--yg-font-main);
        background: #fff;
        color: var(--yg-black);
        overflow-x: hidden;
        scroll-behavior: smooth;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
    }

    /* --- SCROLL ANIMATIONS --- */
    .scroll-fade {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .scroll-fade.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .scroll-fade-left {
        opacity: 0;
        transform: translateX(-40px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .scroll-fade-right {
        opacity: 0;
        transform: translateX(40px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .scroll-fade-left.visible,
    .scroll-fade-right.visible {
        opacity: 1;
        transform: translateX(0);
    }

    /* --- REUSABLE COMPONENTS --- */
    .section-label {
        font-family: var(--yg-font-main);
        font-size: 0.7rem;
        letter-spacing: 5px;
        text-transform: uppercase;
        color: var(--azp-gold);
        margin-bottom: 15px;
        font-weight: 700;
        display: block;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .section-title {
        font-family: var(--yg-font-title);
        font-size: clamp(2.2rem, 5vw, 3.8rem);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        line-height: 1.1;
        margin-bottom: 30px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    .section-title span {
        font-style: normal;
        color: var(--azp-gold);
        opacity: 1;
        font-weight: 700;
        letter-spacing: 8px;
    }

    .divider-line {
        width: 60px;
        height: 2px;
        background: var(--azp-gold);
        margin: 20px 0;
    }

    /* --- 1. HERO SECTION --- */
    .about-hero-minimal {
        height: 85vh;
        position: relative;
        overflow: hidden;
        background: var(--yg-dark);
    }

    .hero-bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.4;
        filter: grayscale(100%) contrast(1.2);
        transition: var(--transition-smooth);
    }

    .about-hero-minimal:hover .hero-bg-image {
        opacity: 0.6;
        filter: grayscale(50%) contrast(1.1);
    }

    .hero-content-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 90%;
        max-width: 1200px;
        z-index: 2;
        color: #fff;
        padding: 0 20px;
        box-sizing: border-box;
    }

    .hero-subtitle {
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        letter-spacing: 5px;
        text-transform: uppercase;
        color: var(--azp-gold);
        margin-bottom: 20px;
        font-weight: 400;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .hero-main-title {
        font-family: var(--yg-font-title);
        font-size: clamp(4rem, 12vw, 8.5rem);
        font-weight: 700;
        text-transform: uppercase;
        line-height: 0.9;
        margin-bottom: 30px;
        letter-spacing: -2px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    .hero-main-title span {
        font-style: italic;
        font-weight: 200;
        opacity: 0.8;
    }

    .hero-scroll-indicator {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.8rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        animation: bounce 2s infinite;
        white-space: nowrap;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateX(-50%) translateY(0);
        }

        40% {
            transform: translateX(-50%) translateY(-10px);
        }

        60% {
            transform: translateX(-50%) translateY(-5px);
        }
    }

    /* --- 2. VISION SECTION --- */
    .vision-section {
        padding: 160px 0;
        /* Padding lebih luas untuk kesan eksklusif */
        background: #ffffff;
        overflow: hidden;
    }

    .vision-container {
        max-width: 1000px;
        margin: 0 auto;
        text-align: center;
        padding: 0 5%;
    }

    .vision-statement {
        font-family: var(--yg-font-main);
        font-weight: 700;
        font-style: normal;
        text-transform: uppercase;
        line-height: 1.3;
        letter-spacing: 1px;
        font-size: clamp(1rem, 1vw, 1rem);
        color: var(--yg-dark);
        margin-bottom: 40px;
        position: relative;
        padding: 0 20px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    .vision-statement::before,
    .vision-statement::after {
        content: "“";
        font-family: var(--yg-font-main);
        font-size: clamp(3rem, 6vw, 4rem);
        color: var(--azp-gold);
        opacity: 0.3;
        position: absolute;
        line-height: 1;
    }

    .vision-statement::before {
        top: -20px;
        left: 0;
    }

    .vision-statement::after {
        content: "”";
        bottom: -40px;
        right: 0;
    }

    .vision-description {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #666;
        max-width: 700px;
        margin: 0 auto;
        font-weight: 300;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        padding: 0 15px;
    }

    /* --- 3. MISSION CARDS --- */
    .mission-section {
        padding: 100px 0;
        background: var(--yg-light);
    }

    .mission-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        margin-top: 60px;
        padding: 0 20px;
    }

    .mission-card {
        background: #fff;
        padding: 50px 40px;
        border-radius: 2px;
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
        word-wrap: break-word;
        overflow-wrap: break-word;
        box-sizing: border-box;
        min-height: 320px;
        display: flex;
        flex-direction: column;
    }

    .mission-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--azp-gold);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.6s ease;
    }

    .mission-card:hover::before {
        transform: scaleX(1);
    }

    .mission-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .mission-number {
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        color: var(--azp-gold);
        font-weight: 600;
        letter-spacing: 3px;
        margin-bottom: 20px;
        display: block;
    }

    .mission-card-title {
        font-family: var(--yg-font-title);
        font-size: clamp(1.5rem, 3vw, 1.8rem);
        font-weight: 500;
        margin-bottom: 20px;
        line-height: 1.2;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    .mission-card-text {
        font-size: 1rem;
        line-height: 1.7;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        flex-grow: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        font-family: var(--yg-font-main);
        font-weight: 400;
        color: #888;
    }

    /* --- 4. FOUNDER SECTION --- */
    .founder-section {
        padding: 140px 0;
        background: #fff;
        position: relative;
        overflow: hidden;
    }

    .founder-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
        padding: 0 20px;
    }

    .founder-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 2px;
        max-width: 100%;
    }

    .founder-image {
        width: 100%;
        height: auto;
        display: block;
        filter: grayscale(100%) contrast(1.1);
        transition: var(--transition-smooth);
        transform: scale(1.05);
    }

    .founder-image-container:hover .founder-image {
        filter: grayscale(0%) contrast(1);
        transform: scale(1);
    }

    .founder-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, 0.3));
        z-index: 1;
    }

    .founder-info {
        position: relative;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .founder-role {
        font-family: var(--yg-font-main);
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 3px;
        color: var(--azp-gold);
        text-transform: uppercase;
        margin-bottom: 15px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .founder-name {
        font-family: var(--yg-font-title);
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        font-size: clamp(2rem, 5vw, 4rem);
        line-height: 1.1;
        margin-bottom: 30px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    .founder-bio {
        font-size: clamp(1rem, 2vw, 1.1rem);
        color: #444;
        border-left: 2px solid var(--azp-gold);
        padding-left: 20px;
        margin-top: 30px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        text-align: justify;
        font-family: var(--yg-font-main);
        font-weight: 400;
        line-height: 1.8;
    }

    .founder-quote {
        margin-top: 40px;
        color: #666;
        font-size: 0.9rem;
        letter-spacing: 2px;
        font-style: italic;
        word-wrap: break-word;
        overflow-wrap: break-word;
        padding-right: 10px;
    }

    /* --- 5. AWARDS SECTION --- */
    .awards-section {
        padding: 120px 0;
        background: var(--yg-dark);
        color: #fff;
        text-align: center;
    }

    .awards-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .awards-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        margin-bottom: 20px;
        color: #fff;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        font-family: var(--yg-font-title);
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 3px;
    }

    .awards-subtitle {
        font-size: 0.9rem;
        letter-spacing: 3px;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 60px;
        text-transform: uppercase;
        word-wrap: break-word;
        overflow-wrap: break-word;
        padding: 0 10px;
    }

    .awards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 50px;
        align-items: center;
        padding: 0 20px;
    }

    .award-item {
        transition: var(--transition-smooth);
        opacity: 0.4;
        filter: grayscale(100%) brightness(2);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 120px;
    }

    .award-item:hover {
        opacity: 1;
        filter: grayscale(0%) brightness(1);
        transform: scale(1.1);
    }

    .award-img {
        width: 100%;
        max-width: 120px;
        height: auto;
        margin: 0 auto;
        object-fit: contain;
    }

    /* --- 6. LOCATION SECTION --- */
    .location-section {
        padding: 120px 0;
        background: #fff;
        text-align: center;
    }

    .location-address {
        font-size: clamp(1rem, 3vw, 1.2rem);
        line-height: 1.6;
        color: #666;
        max-width: 700px;
        margin: 0 auto 60px;
        font-weight: 300;
        position: relative;
        padding: 20px 0;
        word-wrap: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
        padding: 20px;
    }

    .location-address::before {
        content: "📍";
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        font-size: 1.5rem;
        opacity: 0.5;
    }

    .map-container {
        width: 100%;
        height: 500px;
        margin-top: 60px;
        position: relative;
        overflow: hidden;
        border-radius: 2px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        padding: 0 20px;
        box-sizing: border-box;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
        filter: grayscale(100%) contrast(1.1);
        transition: filter 0.6s ease;
    }

    .map-container:hover iframe {
        filter: grayscale(0%) contrast(1);
    }

    /* --- RESPONSIVE DESIGN --- */
    @media (max-width: 1200px) {
        .founder-wrapper {
            gap: 60px;
        }

        .mission-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
    }

    @media (max-width: 992px) {
        .founder-wrapper {
            grid-template-columns: 1fr;
            gap: 50px;
        }

        .founder-image-container {
            max-width: 500px;
            margin: 0 auto;
        }

        .mission-grid {
            grid-template-columns: 1fr;
            gap: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .awards-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .mission-card {
            min-height: auto;
            padding: 40px 30px;
        }
    }

    @media (max-width: 768px) {
        .about-hero-minimal {
            height: 70vh;
        }

        .hero-main-title {
            font-size: clamp(2.5rem, 8vw, 4rem);
        }

        .vision-section,
        .mission-section,
        .founder-section,
        .awards-section,
        .location-section {
            padding: 80px 0;
        }

        .mission-card {
            padding: 35px 25px;
        }

        .awards-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        .map-container {
            height: 400px;
        }

        .founder-bio {
            padding-left: 15px;
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-scroll-indicator {
            bottom: 20px;
            font-size: 0.7rem;
        }

        .vision-statement {
            font-size: clamp(1.5rem, 4vw, 2.2rem);
            padding: 0 15px;
        }

        .vision-statement::before,
        .vision-statement::after {
            font-size: clamp(2rem, 4vw, 3rem);
        }

        .founder-bio {
            font-size: 0.95rem;
            padding-left: 12px;
            text-align: left;
        }

        .awards-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .map-container {
            height: 300px;
        }

        .hero-content-center,
        .vision-container,
        .mission-grid,
        .founder-wrapper,
        .awards-container,
        .map-container {
            padding-left: 15px;
            padding-right: 15px;
        }
    }

    @media (max-width: 400px) {
        .hero-main-title {
            font-size: clamp(2rem, 6vw, 3rem);
        }

        .mission-card {
            padding: 30px 20px;
        }

        .section-title {
            font-size: clamp(2rem, 5vw, 3rem);
        }

        .award-img {
            max-width: 100px;
        }
    }
</style>

<section class="about-hero-minimal">
    <img src="<?= base_url('img/company/' . ($profile['building_img'] ?? 'building.jpg')); ?>"
        alt="AZP Headquarters"
        class="hero-bg-image scroll-fade">

    <div class="hero-content-center">
        <div class="hero-subtitle scroll-fade delay-1">TENTANG PERUSAHAAN</div>
        <h1 class="hero-main-title scroll-fade delay-2">
            AZP <span>Studios Ent.</span>
        </h1>
        <div class="divider-line scroll-fade delay-3" style="margin: 20px auto;"></div>
        <p class="hero-subtitle scroll-fade delay-4" style="margin-top: 30px; font-size: 0.8rem;">
            2026 • INDONESIA • GLOBAL
        </p>
    </div>

    <div class="hero-scroll-indicator">SCROLL TO EXPLORE</div>
</section>

<section class="vision-section">
    <div class="container vision-container">
        <span class="section-label scroll-fade">Our Vision</span>
        <h2 class="section-title scroll-fade delay-1">
            Redefining <span>Musical</span> Boundaries
        </h2>

        <div class="vision-statement scroll-fade delay-2">
            <?= htmlspecialchars($profile['vision'] ?? 'Creating timeless soundscapes that transcend generations and cultures.', ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <p class="vision-description scroll-fade delay-3">
            <?= htmlspecialchars($profile['philosophy'] ?? 'At AZP Studios, we believe music is more than sound—it\'s an emotional architecture. We blend cutting-edge technology with artistic intuition to craft audio experiences that resonate deeply and endure.', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    </div>
</section>

<section class="mission-section">
    <div class="container">
        <span class="section-label scroll-fade">Our Mission</span>
        <h2 class="section-title scroll-fade delay-1" style="color: var(--yg-dark);">
            Three <span>Core</span> Principles
        </h2>

        <div class="mission-grid">
            <div class="mission-card scroll-fade-left delay-1">
                <span class="mission-number">01</span>
                <h3 class="mission-card-title">Artist Empowerment</h3>
                <p class="mission-card-text">
                    <?= htmlspecialchars($profile['mission_1'] ?? 'Nurturing unique voices and providing the creative freedom, resources, and platform for artists to reach their full potential and connect with global audiences.', ENT_QUOTES, 'UTF-8'); ?>
                </p>
            </div>

            <div class="mission-card scroll-fade delay-2">
                <span class="mission-number">02</span>
                <h3 class="mission-card-title">Sonic Innovation</h3>
                <p class="mission-card-text">
                    <?= htmlspecialchars($profile['mission_2'] ?? 'Pioneering new audio technologies and production techniques to create immersive sound experiences that push the boundaries of what music can be.', ENT_QUOTES, 'UTF-8'); ?>
                </p>
            </div>

            <div class="mission-card scroll-fade-right delay-3">
                <span class="mission-number">03</span>
                <h3 class="mission-card-title">Cultural Impact</h3>
                <p class="mission-card-text">
                    <?= htmlspecialchars($profile['mission_3'] ?? 'Creating music that not only entertains but also inspires, challenges perspectives, and contributes meaningfully to the cultural landscape.', ENT_QUOTES, 'UTF-8'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="founder-section">
    <div class="container">
        <div class="founder-wrapper">
            <div class="founder-image-container scroll-fade-left">
                <div class="founder-image-overlay"></div>
                <img src="<?= base_url('img/company/' . ($profile['ceo_img'] ?? 'director.jpg')); ?>"
                    alt="<?= htmlspecialchars($profile['ceo_name'] ?? 'Arraflyaziz', ENT_QUOTES, 'UTF-8'); ?>"
                    class="founder-image">
            </div>

            <div class="founder-info scroll-fade-right">
                <span class="founder-role">Founder CEO PRODUCER</span>
                <h2 class="founder-name"><?= htmlspecialchars($profile['ceo_name'] ?? 'Arraflyaziz', ENT_QUOTES, 'UTF-8'); ?></h2>

                <div class="divider-line"></div>

                <p class="founder-bio">
                    <?= htmlspecialchars($profile['ceo_bio'] ?? 'With over a decade of experience in music production and artist development, our founder combines technical mastery with artistic vision. Leading AZP Studios with a philosophy that great music requires both soul and science, blending emotional depth with technical precision.', ENT_QUOTES, 'UTF-8'); ?>
                </p>

                <div class="founder-quote">
                    <i class='bx bx-quote-left' style="color: var(--azp-gold); margin-right: 10px;"></i>
                    "KOLABORASI TANPA HENTI"
                </div>
            </div>
        </div>
    </div>
</section>

<section class="awards-section">
    <div class="container awards-container">
        <span class="section-label scroll-fade">PENGHARGAAN</span>
        <h2 class="awards-title scroll-fade delay-1">AWARDS and ACHIVMENT</h2>
        <p class="awards-subtitle scroll-fade delay-2">GLOBAL AWARDS IN MUSIC INDUSTRY</p>

        <div class="awards-grid">
            <?php if (!empty($awards)): ?>
                <?php foreach ($awards as $index => $aw): ?>
                    <div class="award-item scroll-fade delay-<?= min($index + 1, 4) ?>">
                        <img src="<?= base_url('img/awards/' . $aw['icon']); ?>"
                            alt="<?= htmlspecialchars($aw['name'], ENT_QUOTES, 'UTF-8'); ?>"
                            class="award-img"
                            title="<?= htmlspecialchars($aw['name'], ENT_QUOTES, 'UTF-8'); ?>"
                            loading="lazy">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="scroll-fade" style="grid-column: 1 / -1; padding: 40px;">
                    <i class='bx bx-award' style="font-size: clamp(2rem, 5vw, 3rem); opacity: 0.2; margin-bottom: 20px;"></i>
                    <p style="opacity: 0.4; font-size: 0.9rem; word-wrap: break-word;">Recognition archive in progress</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="location-section">
    <div class="container">
        <span class="section-label scroll-fade">Visit Us</span>
        <h2 class="section-title scroll-fade delay-1" style="color: var(--yg-dark);">
            Our <span>Locations</span> Hub
        </h2>

        <p class="location-address scroll-fade delay-2">
            <?= htmlspecialchars($profile['address'] ?? 'Sudirman Central Business District (SCBD), Lot 15, Jakarta 12190, Indonesia', ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <div class="map-container scroll-fade delay-3">
            <iframe
                src="<?= htmlspecialchars($profile['maps_link'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.819561!3d-6.224212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnMjcuMiJTIDEwNsKwNDknMTA0LjQiRQ!5e0!3m2!1sen!2sid!4v1641234567890!5m2!1sen!2sid', ENT_QUOTES, 'UTF-8'); ?>"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="AZP Studios Location">
            </iframe>
        </div>
    </div>
</section>

<script>
    // Scroll Animation Observer
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const delay = entry.target.classList.contains('delay-1') ? 100 :
                        entry.target.classList.contains('delay-2') ? 200 :
                        entry.target.classList.contains('delay-3') ? 300 :
                        entry.target.classList.contains('delay-4') ? 400 : 0;

                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, delay);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-fade, .scroll-fade-left, .scroll-fade-right').forEach(function(element) {
            observer.observe(element);
        });

        // Animate hero section immediately
        setTimeout(() => {
            document.querySelectorAll('.about-hero-minimal .scroll-fade').forEach(function(el) {
                el.classList.add('visible');
            });
        }, 300);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });

    // Parallax effect for hero background
    window.addEventListener('scroll', function() {
        const heroSection = document.querySelector('.about-hero-minimal');
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.3;

        if (heroSection) {
            const bgImage = heroSection.querySelector('.hero-bg-image');
            if (bgImage) {
                bgImage.style.transform = `translateY(${rate}px) scale(1.05)`;
            }
        }
    });

    // Handle text overflow on resize
    window.addEventListener('resize', function() {
        document.querySelectorAll('.mission-card-text, .vision-description, .founder-bio').forEach(function(el) {
            el.style.display = 'none';
            el.offsetHeight;
            el.style.display = '';
        });
    });
</script>

<?= $this->endSection(); ?>