<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    :root {
        --accent-red: #e11c24;
        --luxury-black: #0d0d0d;
        --cb-luxe: cubic-bezier(0.23, 1, 0.32, 1);
        --font-heading: 'Oswald', sans-serif; /* Mengganti Syne ke Oswald */
        --font-body: 'Montserrat',
    }

    .unified-wrapper { 
       padding: 100px 5% 100px; 
        max-width: 1200px; 
        margin: 0 auto;
        font-family: var(--font-body);
    }
    
    /* --- HERO SECTION --- */
    .unified-title { 
        font-family: var(--font-heading); 
        font-size: clamp(3rem, 10vw, 7rem); 
        line-height: 1.1; /* Oswald butuh sedikit ruang lebih dibanding Syne */
        text-transform: uppercase; 
        font-weight: 700; 
        letter-spacing: 0.02em; /* Spacing rapat khas YG */
        margin-bottom: 80px;
    }
    .text-outline { color: transparent; -webkit-text-stroke: 1.5px var(--luxury-black); }

    /* --- SECTION LABEL --- */
    .section-label { 
       font-family: var(--font-body);
        font-size: 0.75rem; 
        font-weight: 700; 
        letter-spacing: 0.4em; /* Khas YG yang lebar spacingnya */
        text-transform: uppercase; 
        color: var(--accent-red); 
        margin-bottom: 30px; 
        display: block;
    }

    /* --- SECTION SPONSOR --- */
   /* --- SECTION SPONSOR (BALANCED PROFESSIONAL) --- */
.brand-logo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 60px;
    align-items: center;
    margin-bottom: 120px;
}

.brand-logo-item {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 110px;
}

.brand-logo-item img {
    max-width: 320px;
    max-height: 160px;
    width: auto;
    height: auto;
    object-fit: contain;
    opacity: 0.45;
    filter: grayscale(100%);
    transition: 0.5s var(--cb-luxe);
}

.brand-logo-item img:hover {
    opacity: 1;
    filter: grayscale(0%);
    transform: scale(1.08);
}

/* MOBILE */
@media (max-width: 768px) {
    .brand-logo-grid {
        gap: 40px;
    }

    .brand-logo-item {
        height: 90px;
    }

    .brand-logo-item img {
        max-width: 130px;
        max-height: 55px;
    }
}


   /* --- SECTION CAREER: YG Typography Style --- */
    .career-container { margin-top: 100px; }
    
    .job-info-row {
        padding: 40px 0;
        border-bottom: 1px solid #eee;
        transition: 0.4s var(--cb-luxe);
    }
    .job-info-row:hover { border-color: var(--luxury-black); padding-left: 10px; }
    
    .job-info-row h3 { 
        font-family: var(--font-heading); 
        font-size: 2.2rem; 
        text-transform: uppercase; 
        font-weight: 500; 
        letter-spacing: 1px;
        margin: 5px 0 0 0;
        color: var(--luxury-black);
    }
    .job-meta { 
        font-family: var(--font-body);
        font-size: 0.7rem; 
        font-weight: 700; 
        color: #888; 
        letter-spacing: 2px; 
        text-transform: uppercase;
    }

    /* --- CTA PARTNERSHIP --- */
    .partnership-cta {
        background: var(--luxury-black);
        color: #fff;
        padding: 100px 50px;
        margin-top: 150px;
        text-align: center;
        border-radius: 4px;
    }
    .partnership-cta h2 { font-family: var(--font-heading); 
        font-size: clamp(2rem, 5vw, 4rem); 
        text-transform: uppercase; 
        font-weight: 700;
        margin-bottom: 20px;
     }
     partnership-cta p {
        font-family: var(--font-body);
        font-weight: 400;
        letter-spacing: 0.5px;
    }

    .partnership-cta a {
        font-family: var(--font-body);
        font-weight: 700;
        letter-spacing: 3px;
    }

    @media (max-width: 768px) {
        .unified-wrapper { padding-top: 140px; }
        .job-info-row h3 { font-size: 1.5rem; }
    }
</style>

<div class="unified-wrapper">
    <h1 class="unified-title" data-aos="fade-right">
        RELASI<br><span class="text-outline">and CAREER</span>.
    </h1>

    <section class="mb-5">
        <span class="section-label" data-aos="fade-up">Trusted Partners & Sponsors</span>
        <div class="brand-logo-grid" data-aos="fade-up">
            <?php if (!empty($sponsors)) : foreach ($sponsors as $s) : ?>
               <div class="brand-logo-item">
    <img src="<?= base_url('img/sponsors/' . $s['logo']); ?>" alt="<?= esc($s['name']); ?>">
</div>

            <?php endforeach; else : ?>
                <p class="text-muted small">Belum ada mitra resmi yang ditampilkan.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="career-container">
        <span class="section-label" data-aos="fade-up">Career Opportunities</span>
        <div data-aos="fade-up">
            <?php if (!empty($careers)) : foreach ($careers as $c) : ?>
                <div class="job-info-row">
                    <span class="job-meta"><?= esc($c['category']); ?></span>
                    <h3><?= esc($c['title']); ?></h3>
                </div>
            <?php endforeach; else : ?>
                <p class="text-muted italic">Saat ini belum ada posisi yang tersedia.</p>
            <?php endif; ?>
        </div>
        
        <p class="text-muted mt-4 small italic">
            *Kirimkan CV dan Portofolio Anda ke <strong class="text-dark">arraflyaziz@gmail.com</strong> dengan subjek (Posisi_Nama).
        </p>
    </section>

    <div class="partnership-cta shadow-lg" data-aos="zoom-in">
        <span class="section-label" style="color: #fff; opacity: 0.6;">Business Inquiry</span>
        <h2>Become a Strategic Partner</h2>
        <p class="mb-5 opacity-75">Mari berkolaborasi untuk menciptakan standar baru dalam industri kreatif global.</p>
        <a href="<?= base_url('contact'); ?>" class="btn btn-outline-light px-5 py-3 rounded-pill fw-bold" style="letter-spacing: 3px;">HUBUNGI KAMI</a>
    </div>
</div>

<?= $this->endSection(); ?>