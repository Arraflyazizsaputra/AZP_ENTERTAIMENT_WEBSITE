<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-white: #ffffff;
        --text-black: #0d0d0d;
        --accent-red: #e11c24;
        --soft-grey: #f5f5f5;
        --font-heading: 'Oswald', sans-serif;
        --font-body: 'Montserrat', sans-serif;
        --cb-luxe: cubic-bezier(0.23, 1, 0.32, 1);
    }

    .audition-container {
        padding: 100px 5% 100px;
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Header Optimization */
    .audition-header {
        margin-bottom: 100px;
        position: relative;
    }

    .audition-header .tagline {
        font-family: var(--font-body);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5em;
        /* Spacing lebar khas YG */
        color: var(--accent-red);
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .audition-header h1 {
        font-family: var(--font-heading);
        font-size: clamp(3rem, 10vw, 8rem);
        font-weight: 700;
        line-height: 1.1;
        /* Oswald butuh sedikit ruang dibanding Syne */
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin: 0;
    }

    /* Grid Optimization */
    .audition-grid {
        display: grid;
        /* Diubah agar lebih fleksibel di layar tanggung */
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 0;
        /* Menggunakan border collapse style */
        border-top: 1px solid #e0e0e0;
        border-left: 1px solid #e0e0e0;
    }

    /* Card Item Optimization */
    .audition-item {
        background-color: var(--bg-white);
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 500px;
        transition: all 0.7s var(--cb-luxe);
        text-decoration: none;
        color: var(--text-black);
        border-right: 1px solid #e0e0e0;
        border-bottom: 1px solid #e0e0e0;
        position: relative;
        overflow: hidden;
    }

    .audition-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0;
        background-color: var(--text-black);
        z-index: 0;
        transition: height 0.6s var(--cb-luxe);
    }

    .audition-item:hover {
        color: var(--bg-white);
    }

    .audition-item:hover::after {
        height: 100%;
    }

    .audition-item>* {
        position: relative;
        z-index: 1;
    }

    /* Fix: Text Overflow & Typography */
    .audition-category {
        font-family: var(--font-body);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: #999;
    }

    .audition-item:hover .audition-category {
        color: var(--accent-red);
    }

    .audition-title {
        font-family: var(--font-heading);
        font-size: 1.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 25px;
        word-wrap: break-word;
        /* Mencegah kata panjang keluar box */
    }

    /* SOLUSI HURUF KELUAR BARIS */
    .audition-requirements {
        font-family: var(--font-body);
        font-size: 0.95rem;
        line-height: 1.8;
        font-weight: 400;
        opacity: 0.7;
        /* Sedikit lebih redup di awal agar estetik */
        color: var(--text-black);
        /* Mengikuti variabel warna hitam Anda */

        /* Line Clamping - Membatasi maksimal 3 baris teks */
        display: -webkit-box;

        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;

        /* TRANSISI: Penting agar perubahan warna halus (smooth) */
        transition: color 0.4s ease, opacity 0.4s ease;
    }

    .audition-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #eee;
        padding-top: 30px;
        transition: border-color 0.4s ease;
    }

    .audition-item:hover .audition-requirements {
        color: #ffffff !important;
        /* Paksa jadi putih saat background jadi hitam */
        opacity: 1;
        /* Lebih terang agar terbaca jelas di background gelap */
    }

    .deadline-tag {
        font-family: var(--font-body);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .apply-arrow {
        font-size: 2rem;
        transform: translateX(-15px);
        opacity: 0;
        transition: all 0.5s var(--cb-luxe);
        color: var(--accent-red);
    }

    .audition-item:hover .apply-arrow {
        transform: translateX(0);
        opacity: 1;
    }

    /* Reveal Animation */
    .reveal-audition {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s var(--cb-luxe);
    }

    .reveal-audition.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Empty State Styling */
    .empty-state {
        grid-column: 1 / -1;
        padding: 100px 50px;
        text-align: center;
        background: var(--soft-grey);
        border: none !important;
    }

    .empty-state p {
        font-family: var(--font-heading);
        font-size: 1.4rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #bbb;
    }

    @media (max-width: 768px) {
        .audition-container {
            padding-top: 120px;
        }

        .audition-header h1 {
            font-size: 4rem;
        }

        .audition-item {
            padding: 40px;
            min-height: 400px;
        }

        .audition-grid {
            grid-template-columns: 1fr;
            border-left: none;
            border-right: none;
        }
    }
</style>

<div class="audition-container">
    <header class="audition-header">
        <span class="tagline" data-aos="fade-right">Join the Legacy</span>
        <h1 data-aos="fade-up">Global<br>Audition<span style="color:var(--accent-red)">.</span></h1>
    </header>

    <div class="audition-grid">
        <?php if (!empty($auditions)) : ?>
            <?php foreach ($auditions as $row) : ?>
                <a href="<?= base_url('auditions/apply/' . $row['id']); ?>" class="audition-item reveal-audition">
                    <div>
                        <div class="audition-category"><?= esc($row['category']); ?></div>
                        <h2 class="audition-title"><?= esc($row['title']); ?></h2>
                        <div class="audition-requirements">
                            <?= esc($row['requirements']); ?>
                        </div>
                    </div>

                    <div class="audition-footer">
                        <div class="deadline-tag">
                            UNTIL <?= date('d M Y', strtotime($row['deadline'])); ?>
                        </div>
                        <div class="apply-arrow">
                            <i class='bx bx-right-arrow-alt'></i>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="audition-item empty-state">
                <p>No Open Casting Calls at the Moment</p>
                <small class="text-muted text-uppercase" style="letter-spacing: 2px;">Stay tuned for the next generation</small>
            </div>
        <?php endif; ?>
    </div>
</div>



<script>
    // Intersection Observer untuk animasi masuk
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const auditionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal-audition').forEach((item, index) => {
        item.style.transitionDelay = `${index * 0.15}s`;
        auditionObserver.observe(item);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Notifikasi Sukses (Hanya muncul di sini setelah redirect)
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                title: 'APPLICATION SENT!',
                text: '<?= session()->getFlashdata('success'); ?>',
                icon: 'success',
                confirmButtonColor: '#000',
                confirmButtonText: 'MENGERTI',
                background: '#fff',
                customClass: {
                    title: 'fw-bold',
                    popup: 'rounded-4'
                }
            });
        <?php endif; ?>
    });
</script>

<?= $this->endSection(); ?>