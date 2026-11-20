<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    :root {
        --azp-yellow: #FFD700;
        --azp-dark: #1a1a1a;
        --azp-white: #ffffff;
        --card-height: 220px;
        --font-primary: 'Montserrat', sans-serif;
        --font-heading: 'Oswald', sans-serif;
    }

    body {
       background-color: #f8f9fa;
        scroll-behavior: smooth;
        overflow-x: hidden;
        font-family: var(--font-primary);
    }

    /* --- Typography --- */
    .section-header h1 {
        font-family: var(--font-heading); /* Menggunakan Oswald */
        font-weight: 700;
        text-transform: uppercase; /* YG style identik dengan Uppercase */
        font-size: clamp(2.5rem, 5vw, 4rem);
        letter-spacing: 2px;
        color: var(--azp-dark);
    }
    .section-header h6 {
        font-family: var(--font-primary);
        letter-spacing: 5px; /* Spacing lebar khas YG */
        font-weight: 800;
    }

    /* --- Navigation --- */
    .category-nav {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 50px;
        position: sticky;
        top: 20px;
        z-index: 1000;
        padding: 5px;
        /* Perbaikan: Agar scroll horizontal di mobile lancar */
        overflow-x: auto;
        flex-wrap: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    /* Perbaikan: Menghilangkan scrollbar nav tapi tetap bisa di-scroll */
    .category-nav::-webkit-scrollbar {
        display: none;
    }

    .nav-pill-custom {
        padding: 12px 25px;
        background: var(--azp-dark);
        color: white;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border: 2px solid transparent;
        white-space: nowrap;
        flex-shrink: 0;
        font-family: var(--font-primary);
        letter-spacing: 2px;
        text-transform: uppercase;
   
        /* Tambahan: Mencegah pil mengecil di mobile */
    }

    .nav-pill-custom:hover,
    .nav-pill-custom.active {
        background: var(--azp-yellow);
        color: var(--azp-dark);
        transform: translateY(-3px);
    }

    .nav-pill-custom.active {
        border-color: var(--azp-dark);
    }

    /* --- Creative Card Design --- */
    .creative-card {
        display: flex;
        height: var(--card-height);
        background: var(--azp-white);
        border-radius: 35px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .creative-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
        border-color: var(--azp-yellow);
    }

    /* Info Side (Left) */
    .card-info {
        flex: 1.3;
        background: var(--azp-dark);
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: var(--azp-white);
        position: relative;
        z-index: 5;
    }

    .brand-icon-small {
        position: absolute;
        top: 20px;
        left: 30px;
        color: var(--azp-yellow);
        font-size: 1.3rem;
        opacity: 0.5;
    }

    .artist-name {
        font-family: var(--font-heading); /* Menggunakan Oswald */
        font-size: clamp(1.4rem, 2vw, 2.2rem);
        font-weight: 700;
        text-transform: uppercase;
        line-height: 1;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .artist-role {
        font-family: var(--font-primary);
        color: var(--azp-yellow);
        font-size: 0.7rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .btn-profile {
        margin-top: 20px;
        padding: 10px 24px;
        background: rgba(255, 255, 255, 0.08);
        color: var(--azp-white);
        border-radius: 30px;
        font-size: 0.75rem;
        transition: 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.1);
        width: fit-content;
        font-family: var(--font-primary);
        letter-spacing: 2px;
        font-weight: 700;
    }

    .btn-profile:hover {
        background: var(--azp-yellow);
        color: var(--azp-dark);
        border-color: var(--azp-yellow);
    }

    /* Visual Side (Right) */
    .card-visual {
        flex: 1;
        background: var(--azp-yellow);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .artist-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 6px solid var(--azp-white);
        overflow: hidden;
        z-index: 2;
        transition: 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .artist-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .creative-card:hover .artist-circle {
        transform: scale(1.1) rotate(3deg);
    }

    /* Hover Overlay */
    .streaming-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
        z-index: 10;
        backdrop-filter: blur(8px);
    }

    .creative-card:hover .streaming-overlay {
        opacity: 1;
        visibility: visible;
    }

    .overlay-label {
        color: var(--azp-yellow);
        font-size: 0.65rem;
        margin-bottom: 15px;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        font-family: var(--font-primary);
        letter-spacing: 4px;
        font-weight: 800;
    }

    .btn-profile-hover {
        background: linear-gradient(135deg, #FFD700 0%, #B8860B 100%);
        color: #000;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.85rem;
        margin-bottom: 15px;
        box-shadow: 0 5px 15px rgba(184, 134, 11, 0.4);
        transition: 0.3s;
        font-family: var(--font-primary);
        letter-spacing: 1px;
    }

    .btn-profile-hover:hover {
        transform: scale(1.05) translateY(-3px);
        box-shadow: 0 10px 25px rgba(255, 215, 0, 0.6);
        background: #fff;
    }

    .stream-link {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: 0.3s;
        font-size: 1.4rem;
        border: 1px solid rgba(255, 215, 0, 0.4);
    }

    .stream-link:hover {
        background: var(--azp-yellow);
        color: var(--azp-dark);
        transform: scale(1.15);
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
    }

    /* --- BAND CARD --- */
    .card-band {
        flex-direction: column;
        aspect-ratio: 1 / 1;
        height: auto;
        border-radius: 25px;
        /* Perbaikan: Gunakan radius agar konsisten */
        background: var(--azp-dark);
        border: 1px solid rgba(255, 215, 0, 0.1);
    }

    .card-band .card-visual {
        flex: 5.5;
        width: 100%;
        border-radius: 0;
    }

    .card-band .artist-circle {
        width: 100%;
        height: 100%;
        border-radius: 0;
        border: none;
        transform: none;
    }

    .card-band .artist-circle img {
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .card-band:hover .artist-circle img {
        transform: scale(1.08);
    }

    .card-band .card-info {
        flex: 1;
        width: 100%;
        padding: 15px;
        text-align: center;
        align-items: center;
        justify-content: center;
        background: var(--azp-dark);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 0;
    }

    .card-band .artist-name {
        font-size: clamp(1.2rem, 2.5vw, 1.8rem);
        font-weight: 800;
        letter-spacing: 1px;
        color: var(--azp-white);
        text-transform: uppercase;
    }

    .card-band .artist-role,
    .card-band .brand-icon-small,
    .card-band .btn-profile {
        display: none;
    }

    /* --- ACTOR CARD --- */
    .card-aktor {
        flex-direction: column;
        aspect-ratio: 2 / 3;
        height: auto;
        background: #000;
        position: relative;
        overflow: hidden;
        border-radius: 25px;
        /* Perbaikan: Gunakan radius agar konsisten */
    }

    .card-aktor .card-visual,
    .card-aktor .artist-circle {
        height: 100%;
        width: 100%;
        border-radius: 0;
        border: none;
        flex: none;
    }

    .card-aktor .artist-circle img {
        object-fit: cover;
        transition: transform 1s ease;
    }

    .card-aktor:hover .artist-circle img {
        transform: scale(1.1);
    }

    .card-aktor .card-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.6) 40%, transparent 100%);
        z-index: 5;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        padding: 30px 15px;
        transition: 0.4s ease;
    }

    .card-aktor .artist-name {
        font-size: clamp(1.2rem, 2vw, 2.2rem);
        text-transform: uppercase;
        color: white;
        font-family: var(--font-heading);
        letter-spacing: 1px;
    }

    .card-aktor .artist-role {
        color: var(--azp-yellow);
        font-size: 0.7rem;
        letter-spacing: 4px;
        margin-bottom: 15px;
    }

    .card-aktor .brand-icon-small,
    .card-aktor .card-info .btn-profile {
        display: none;
    }

    /* --- Modal Styles --- */
    .modal-dialog {
        /* Perbaikan: Menambah margin agar tidak menempel di layar HP */
        margin: 1.75rem auto;
    }

    .modal-title, .artist-detail-title {
        font-family: var(--font-heading);
        text-transform: uppercase;
    }

    /* --- Responsive --- */
    @media (max-width: 992px) {
        :root {
            --card-height: 200px;
        }

        .artist-circle {
            width: 120px;
            height: 120px;
        }
    }

    @media (max-width: 768px) {
        .creative-card {
            flex-direction: column;
            height: auto;
            border-radius: 30px;
        }

        .card-info {
            padding: 40px 30px 30px;
            align-items: center;
            text-align: center;
        }

        .brand-icon-small {
            left: 50%;
            transform: translateX(-50%);
        }

        .card-visual {
            height: 220px;
        }

        .artist-circle {
            width: 140px;
            height: 140px;
        }

        .category-nav {
            justify-content: flex-start;
            padding: 10px 20px;
        }

        .card-aktor .artist-name {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container py-5">
    <div class="section-header text-center mb-5">
        <h6 class="text-uppercase text-muted fw-bold mb-2">AZP Studio Talent</h6>
        <h1>Our <?= ucfirst($current_cat == 'aktor' ? 'Actors' : ($current_cat == 'band' ? 'Bands' : 'Soloists')); ?></h1>
        <div class="mt-3 mx-auto" style="width: 80px; height: 5px; background: var(--azp-yellow); border-radius: 10px;"></div>
    </div>

    <div class="category-nav">
        <a href="<?= base_url('artists/soloist'); ?>" class="nav-pill-custom <?= $current_cat == 'soloist' ? 'active' : ''; ?>">
            <i class='bx bxs-microphone me-2'></i> SOLOIST
        </a>
        <a href="<?= base_url('artists/band'); ?>" class="nav-pill-custom <?= $current_cat == 'band' ? 'active' : ''; ?>">
            <i class='bx bxs-group me-2'></i> GRUP BAND
        </a>
        <a href="<?= base_url('artists/aktor'); ?>" class="nav-pill-custom <?= $current_cat == 'aktor' ? 'active' : ''; ?>">
            <i class='bx bxs-camera-movie me-2'></i> AKTOR
        </a>
    </div>

    <section class="mb-5">
        <div class="row g-4 justify-content-center">
            <?php if (!empty($artists)) : ?>
                <?php foreach ($artists as $a) : ?>
                    <?php
                    // Logika Penentuan Kolom & Class
                    $colClass = 'col-xl-6';
                    $cardClass = '';
                    if ($current_cat == 'band') {
                        $colClass = 'col-md-6';
                        $cardClass = 'card-band';
                    } elseif ($current_cat == 'aktor') {
                        $colClass = 'col-md-6 col-lg-4';
                        $cardClass = 'card-aktor';
                    }
                    ?>
                    <div class="<?= $colClass; ?>">
                        <div class="creative-card <?= $cardClass; ?>"
                            onclick="window.location.href='<?= base_url('artist/profile/' . $a['id']); ?>'"
                            style="cursor: pointer;">

                            <div class="card-info">
                                <i class='bx bxs-star brand-icon-small'></i>
                                <h3 class="artist-name"><?= esc($a['name']); ?></h3>
                                <span class="artist-role"><?= strtoupper($current_cat); ?> / AZP TALENT</span>
                                <button class="btn-profile">
                                    VIEW PROFILE
                                </button>
                            </div>

                            <div class="card-visual">
                                <div class="artist-circle">
                                    <img src="<?= base_url('img/artists/' . $a['photo']); ?>"
                                        alt="<?= esc($a['name']); ?>"
                                        loading="lazy"
                                        onerror="this.src='<?= base_url('img/no-photo.jpg'); ?>'">
                                </div>

                                <div class="streaming-overlay">
    <span class="overlay-label">
        <?= $current_cat == 'aktor' ? 'FOLLOW TALENT' : 'STREAMING NOW'; ?>
    </span>

    <button class="btn-profile-hover mb-3" onclick="window.location.href='<?= base_url('artist/profile/' . $a['id']); ?>'">
        <i class='bx bx-user-circle me-1'></i> FULL BIO
    </button>

    <div class="d-flex gap-3">
        <?php if ($current_cat != 'aktor'): ?>
            <?php if (!empty($a['spotify_link'])): ?>
                <a href="<?= $a['spotify_link']; ?>" onclick="event.stopPropagation()" target="_blank" class="stream-link" title="Spotify">
                    <i class='bx bxl-spotify'></i>
                </a>
            <?php endif; ?>

            <?php if (!empty($a['apple_link'])): ?>
                <a href="<?= $a['apple_link']; ?>" onclick="event.stopPropagation()" target="_blank" class="stream-link" title="Apple Music">
                    <i class='bx bxl-apple'></i>
                </a>
            <?php endif; ?>

            <?php if (!empty($a['youtube_link'])): ?>
                <a href="<?= $a['youtube_link']; ?>" onclick="event.stopPropagation()" target="_blank" class="stream-link" title="YouTube">
                    <i class='bx bxl-youtube'></i>
                </a>
            <?php endif; ?>

        <?php else: ?>
            <a href="<?= $a['ig_link'] ?? '#'; ?>" onclick="event.stopPropagation()" target="_blank" class="stream-link" title="Instagram">
                <i class='bx bxl-instagram'></i>
            </a>
            <a href="<?= $a['tiktok_link'] ?? '#'; ?>" onclick="event.stopPropagation()" target="_blank" class="stream-link" title="TikTok">
                <i class='bx bxl-tiktok'></i>
            </a>
        <?php endif; ?>
    </div>
</div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-12 text-center py-5">
                    <i class='bx bx-user-x display-1 text-muted opacity-25'></i>
                    <h5 class="text-muted mt-3">No talent found in this category.</h5>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
        let discoSwiper; // SIMPAN INSTANCE SWIPER

        function openFloatingProfile(artistId) {
            const modalElement = document.getElementById('artistModal');
            const target = document.getElementById('detail-target') || modalElement.querySelector('.modal-content');

            // 1. Loading State
            target.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" 
             style="min-height: 450px; background: #141726; border-radius: 24px;">
            <div class="spinner-border text-warning" role="status"></div>
        </div>`;

            const myModal = bootstrap.Modal.getOrCreateInstance(modalElement);
            myModal.show();

            // 2. Fetch data
            fetch('<?= base_url('artist/detail/'); ?>' + artistId)
                .then(response => response.text())
                .then(html => {
                    target.innerHTML = html;

                    // 3. INIT SWIPER (FIXED, TANPA UBAH FUNGSI UTAMA)
                    setTimeout(() => {
                        const swiperContainer = target.querySelector('.swiperArtistCard');

                        if (swiperContainer) {

                            // HANCURKAN SWIPER SEBELUMNYA JIKA ADA
                            if (discoSwiper) {
                                discoSwiper.destroy(true, true);
                                discoSwiper = null;
                            }

                            // BUAT SWIPER BARU
                            discoSwiper = new Swiper(swiperContainer, {
                                slidesPerView: 1,
                                spaceBetween: 30,
                                centeredSlides: true,
                                loop: false,

                                navigation: {
                                    nextEl: target.querySelector('.disco-next'),
                                    prevEl: target.querySelector('.disco-prev'),
                                },

                                observer: true,
                                observeParents: true,
                            });
                            const swiperWrapper = swiperContainer.querySelector('.swiper-wrapper');
                            const scrollAmount = 260;

                            target.querySelector('.disco-next')?.addEventListener('click', () => {
                                swiperWrapper.scrollBy({
                                    left: scrollAmount,
                                    behavior: 'smooth'
                                });
                            });

                            target.querySelector('.disco-prev')?.addEventListener('click', () => {
                                swiperWrapper.scrollBy({
                                    left: -scrollAmount,
                                    behavior: 'smooth'
                                });
                            });

                        }
                    }, 200);
                })
                .catch(() => {
                    target.innerHTML = `
                <div class="p-5 text-center text-danger">
                    Gagal memuat profil.
                </div>`;
                });
        }

        function loadArtistDetail(id) {
            openFloatingProfile(id);
        }
    </script>


    <?= $this->endSection(); ?>