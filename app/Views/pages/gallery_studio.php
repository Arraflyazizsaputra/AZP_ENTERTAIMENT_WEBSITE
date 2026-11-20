<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<style>
    :root {
        --bg-white: #ffffff;
        --text-dark: #0a0a0a;
        --accent-red: #e11c24;
        --soft-gray: #f8f8f8;
        --font-heading: 'Oswald', sans-serif;
        /* Mengganti Syne ke Oswald */
        --font-body: 'Montserrat', sans-serif;
        --transition-main: all 0.7s cubic-bezier(0.23, 1, 0.32, 1);
    }

    body {
        background-color: var(--bg-white);
        color: var(--text-dark);
        font-family: var(--font-body);
        margin: 0;
        overflow-x: hidden;
        cursor: none !important;
    }

    /* --- FIX BUG CURSOR: High Priority Z-Index --- */
    .cursor-follower {
        position: fixed;
        width: 12px;
        height: 12px;
        background-color: var(--text-dark);
        border-radius: 50%;
        pointer-events: none;
        /* Sangat penting: agar tidak menghalangi klik tombol */
        transform: translate(-50%, -50%);
        z-index: 999999;
        /* Angka ekstrim agar tidak tertutup apapun */
        mix-blend-mode: difference;
        transition: width 0.3s ease, height 0.3s ease, background-color 0.3s ease, opacity 0.3s ease;
    }

    /* State kursor saat menyentuh elemen interaktif */
    .cursor-follower.active {
        width: 80px;
        height: 80px;
        background-color: #ffffff;
        opacity: 0.8;
    }

    /* --- LAYOUT RAPIH --- */
    .gallery-wrapper {
        padding: 100px 7% 120px;
        max-width: 1800px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 120px;
        max-width: 800px;
    }

    .page-header span {
        font-family: var(--font-body);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.4em;
        /* Khas YG yang lebar spacingnya */
        text-transform: uppercase;
        color: var(--accent-red);
        display: block;
        margin-bottom: 20px;
    }

    .page-header h1 {
        font-family: var(--font-heading);
        font-size: clamp(3.5rem, 9vw, 6.5rem);
        line-height: 1.1;
        /* Oswald butuh sedikit ruang dibanding Syne */
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.02em;
        /* Spacing rapat khas YG headlines */
        margin: 0;
    }

    /* --- GRID GALLERY PREMIUM --- */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }

    .gallery-card {
        position: relative;
        background-color: var(--soft-gray);
        aspect-ratio: 10 / 13;
        /* Rasio potret elegan */
        overflow: hidden;
        cursor: none;
        /* Pastikan tetap menggunakan custom kursor */
    }

    .gallery-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: var(--transition-main);
    }

    .gallery-card:hover img {
        transform: scale(1.1);
        filter: grayscale(0%);
    }

    /* Overlay Info */
    .gallery-info {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 50px 40px;
        background: linear-gradient(to top, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.8) 40%, transparent 100%);
        transform: translateY(100%);
        transition: var(--transition-main);
    }

    .gallery-card:hover .gallery-info {
        transform: translateY(0);
    }

    .gallery-info h3 {
        font-family: var(--font-heading);
        font-size: 1.2rem;
        font-weight: 500;
        text-transform: uppercase;
        margin: 0;
        letter-spacing: 1.5px;
    }

    /* --- LOAD MORE BUTTON RAPIH --- */
    .load-more-container {
        margin-top: 150px;
        display: flex;
        justify-content: center;
    }

    #btn-load-more {
        font-family: var(--font-body);
        background: transparent;
        border: 1px solid #ddd;
        padding: 22px 70px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        transition: all 0.4s ease;
    }

    #btn-load-more:hover {
        background-color: var(--text-dark);
        color: white;
        border-color: var(--text-dark);
        padding: 25px 100px;
    }

    /* --- MODAL LIGHTBOX PREMIUM --- */
    .modal-content {
        background-color: #fff;
        border-radius: 0;
        border: none;
    }

    .modal-body {
        padding: 80px 40px !important;
    }

    #lightbox-img {
        width: auto;
        max-width: 100%;
        max-height: 75vh;
        object-fit: contain;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
    }

    #lightbox-title {
        font-family: var(--font-heading);
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 40px;
        font-size: clamp(1.5rem, 4vw, 2.8rem);
        letter-spacing: 1px;
    }

    .btn-close-custom {
        background: none;
        border: none;
        font-weight: 700;
        font-size: 0.65rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-top: 40px;
        padding: 10px 20px;
        border-bottom: 2px solid var(--text-dark);
        transition: 0.3s;
        font-family: var(--font-body);
    }

    .btn-close-custom:hover {
        letter-spacing: 6px;
        color: var(--accent-red);
        border-color: var(--accent-red);
    }

    /* RESPONSIVE */
    @media (max-width: 1200px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
    }

    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }

        .gallery-wrapper {
            padding-top: 120px;
        }

        body {
            cursor: auto !important;
        }

        .cursor-follower {
            display: none;
        }
    }
</style>

<div class="cursor-follower" id="cursor"></div>

<div class="gallery-wrapper">
    <header class="page-header" data-aos="fade-up">
        <span>Archives</span>
        <h1>Studio<br>Gllery CEO<span>.</span></h1>
    </header>

    <div class="gallery-grid" id="gallery-container">
        <?php if (!empty($gallery)) :
            foreach ($gallery as $item) : ?>
                <div class="gallery-card" data-aos="fade-up" onclick="showLightbox('<?= base_url('img/gallery/' . $item['image']); ?>', '<?= addslashes(esc($item['title'])); ?>')">
                    <img src="<?= base_url('img/gallery/' . $item['image']); ?>" alt="<?= $item['title']; ?>">
                    <div class="gallery-info">
                        <h3><?= $item['title']; ?></h3>
                    </div>
                </div>
        <?php endforeach;
        endif; ?>
    </div>

    <?php
    $db = \Config\Database::connect();
    $totalInDb = $db->table('gallery')->countAllResults();
    $currentlyShown = count($gallery);
    ?>

    <?php if ($totalInDb > 3) : // Ubah pengecekan menjadi > 3 
    ?>
        <div class="load-more-container" id="load-more-area" data-aos="fade-up">
            <button id="btn-load-more">
                <span id="text-more">Explore Collection</span>
            </button>
        </div>
    <?php endif; ?>
</div>

<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body d-flex flex-column align-items-center">
                <img id="lightbox-img" src="" class="img-fluid">
                <h2 id="lightbox-title"></h2>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">CLOSE ARCHIVE</button>
            </div>
        </div>
    </div>
</div>



<script>
    /* --- CURSOR ENGINE: FIXED BUG --- */
    const cursor = document.getElementById('cursor');

    // Gunakan requestAnimationFrame untuk performa kursor yang lebih mulus
    let mouseX = 0,
        mouseY = 0;
    let cursorX = 0,
        cursorY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;

        // Cek interaksi elemen
        const target = e.target;
        if (target.closest('a, button, .gallery-card, .btn-close-custom')) {
            cursor.classList.add('active');
        } else {
            cursor.classList.remove('active');
        }
    });

    function animateCursor() {
        // Efek lagging kursor yang mewah
        cursorX += (mouseX - cursorX) * 0.2;
        cursorY += (mouseY - cursorY) * 0.2;

        cursor.style.left = cursorX + 'px';
        cursor.style.top = cursorY + 'px';

        requestAnimationFrame(animateCursor);
    }
    animateCursor();

    /* --- LIGHTBOX --- */
    function showLightbox(src, title) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-title').innerText = title;
        const myModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
        myModal.show();
    }

    /* --- AJAX LOAD MORE --- */
    let currentOffset = document.querySelectorAll('.gallery-card').length;
    const btnLoadMore = document.getElementById('btn-load-more');
    const galleryContainer = document.getElementById('gallery-container');

    if (btnLoadMore) {
        btnLoadMore.addEventListener('click', function() {
            const textMore = document.getElementById('text-more');
            textMore.innerText = "Synchronizing...";

            fetch(`<?= base_url('gallery/loadMore'); ?>?offset=${currentOffset}`)
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success' && res.data.length > 0) {
                        res.data.forEach((item, index) => {
                            const card = document.createElement('div');
                            card.className = 'gallery-card';
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(30px)';

                            const cleanTitle = item.title.replace(/'/g, "\\'");

                            card.setAttribute('onclick', `showLightbox('${res.base_url}${item.image}', '${cleanTitle}')`);
                            card.innerHTML = `
                                <img src="${res.base_url}${item.image}" alt="${item.title}">
                                <div class="gallery-info">
                                    <h3>${item.title}</h3>
                                </div>
                            `;
                            galleryContainer.appendChild(card);

                            setTimeout(() => {
                                card.style.transition = 'all 1s cubic-bezier(0.23, 1, 0.32, 1)';
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            }, index * 100);
                        });

                        currentOffset += res.data.length;
                        textMore.innerText = "Explore Archive";

                        if (currentOffset >= <?= $totalInDb ?>) {
                            document.getElementById('load-more-area').style.display = 'none';
                        }
                    } else {
                        textMore.innerText = "ALL VISUALS LOADED";
                        btnLoadMore.style.display = 'none';
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    textMore.innerText = "Connection Error";
                });
        });
    }
</script>

<?= $this->endSection(); ?>