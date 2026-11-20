<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --accent-red: #e11c24;
        --luxury-black: #0d0d0d;
        --text-muted: #666666;
        --border-color: #e5e5e5;
        --soft-bg: #fdfdfd;
        --cb-luxe: cubic-bezier(0.23, 1, 0.32, 1);
        /* FONT YG STYLE */
        --font-heading: 'Oswald', sans-serif;
        /* Mengganti Syne */
        --font-body: 'Montserrat', sans-serif;
        /* Mengganti Inter */
    }

    body {
        background-color: #fff;
        color: var(--luxury-black);
        font-family: var(--font-body);
    }

    .contact-wrapper {
        padding: 100px 8% 120px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* 1. HEADER: Sophisticated & Restrained */
    .contact-header {
        text-align: center;
        margin-bottom: 100px;
    }

    .contact-header span {
        font-family: var(--font-body);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5em;
        /* Spacing lebar khas YG */
        text-transform: uppercase;
        color: var(--accent-red);
        display: block;
        margin-bottom: 20px;
    }

    .contact-header h1 {
        font-family: var(--font-heading);
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: 0.02em;
        /* Oswald butuh spacing rapat untuk kesan bold */
        text-transform: uppercase;
        margin: 0;
    }

    .contact-header p {
        font-family: var(--font-body);
        font-size: 1rem;
        color: var(--text-muted);
        max-width: 500px;
        margin: 30px auto 0;
        line-height: 1.7;
    }

    /* 2. INFO CARDS: Formal Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        margin-bottom: 120px;
    }

    .info-card {
        padding: 40px;
        border: 1px solid var(--border-color);
        text-align: left;
        transition: all 0.4s var(--cb-luxe);
        background: #fff;
    }

    .info-card:hover {
        border-color: var(--luxury-black);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.03);
    }

    .info-card i {
        font-size: 1.5rem;
        margin-bottom: 25px;
        display: block;
        color: var(--luxury-black);
    }

    .info-card h4 {
        font-family: var(--font-body);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-bottom: 15px;
        color: var(--text-muted);
    }

    .info-card p {
        font-family: var(--font-body);
        font-size: 0.95rem;
        line-height: 1.6;
        font-weight: 500;
    }

    /* 3. FORM: Professional & Structured */
    .form-container {
        display: grid;
        grid-template-columns: 0.8fr 1.2fr;
        gap: 80px;
        align-items: start;
        border-top: 1px solid var(--border-color);
        padding-top: 100px;
    }

    .form-instruction h2 {
        font-family: var(--font-heading);
        font-size: 2.2rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .form-instruction p {
        font-family: var(--font-body);
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.8;
    }

    .form-group {
        margin-bottom: 35px;
    }

    .form-group label {
        font-family: var(--font-body);
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-bottom: 12px;
        display: block;
    }

    .form-control-luxe {
        font-family: var(--font-body);
        width: 100%;
        background-color: var(--soft-bg);
        border: 1px solid var(--border-color);
        padding: 18px 20px;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .form-control-luxe:focus {
        border-color: var(--luxury-black);
        background-color: #fff;
    }

    .btn-submit {
        font-family: var(--font-body);
        background: var(--luxury-black);
        color: #fff;
        border: none;
        padding: 22px 40px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.4s var(--cb-luxe);
    }

    .btn-submit:hover {
        background: var(--accent-red);
        transform: translateY(-5px);
    }

    .mt-5 h4 {
        font-family: var(--font-body);
    }

    /* --- Pembaruan Ukuran Social Media --- */

/* Memperbesar kontainer ikon */
.form-instruction .d-flex.gap-3.mt-3 {
    gap: 1.5rem !important; /* Jarak antar ikon lebih lebar */
    margin-top: 1.5rem !important;
}

/* Memperbesar link dan ikon */
.form-instruction a i {
    font-size: 2.2rem !important; /* Ukuran ikon diperbesar (sebelumnya 1.2rem) */
    transition: all 0.3s var(--cb-luxe);
    color: var(--luxury-black);
}

/* Efek Hover yang lebih premium */
.form-instruction a:hover i {
    color: var(--accent-red); /* Berubah merah saat disentuh */
    transform: translateY(-5px) scale(1.1); /* Sedikit melompat dan membesar */
}

/* Memperjelas tulisan "FOLLOW US" */
.mt-5 h4 {
    font-size: 0.8rem !important; /* Sedikit lebih besar */
    letter-spacing: 4px !important; /* Spacing lebih luas khas YG */
    margin-bottom: 20px;
    opacity: 0.8;
}

    @media (max-width: 992px) {
        .form-container {
            grid-template-columns: 1fr;
            gap: 50px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .contact-wrapper {
            padding-top: 120px;
        }
    }
</style>

<div class="contact-wrapper">
    <header class="contact-header" data-aos="fade-up">
        <span>Connect with us</span>
        <h1>CONTACT<br>AZP Ent.</h1>
        <p>Hubungi tim kami untuk konsultasi proyek, kolaborasi kreatif, atau pertanyaan seputar manajemen artis.</p>
    </header>

    <div class="info-grid">
        <div class="info-card" data-aos="fade-up" data-aos-delay="100">
            <i class='bx bx-map-alt'></i>
            <h4>Head Office</h4>
            <p><?= esc($profile['address'] ?? 'Subang, West Java, Indonesia'); ?></p>
        </div>
        <div class="info-card" data-aos="fade-up" data-aos-delay="200">
            <i class='bx bx-envelope'></i>
            <h4>Email Inquiry</h4>
            <p>info@azpstudio.com<br>arraflyaziz@gmail.com</p>
        </div>
        <div class="info-card" data-aos="fade-up" data-aos-delay="300">
            <i class='bx bx-phone'></i>
            <h4>Customer Line</h4>
            <p>+62 821 1234 5678<br>Sen - Jum (09:00 - 17:00)</p>
        </div>
    </div>

    <div class="form-container">
        <div class="form-instruction" data-aos="fade-right">
            <h2>Kirim Pesan</h2>
            <p>Tim kami akan meninjau permintaan Anda secara mendalam. Mohon berikan detail informasi yang jelas agar kami dapat memberikan solusi terbaik. Kami biasanya merespons dalam waktu 1-2 hari kerja.</p>

            <div class="mt-5">
                <h4 style="font-size: 0.7rem; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;">Follow Us</h4>
                <div class="d-flex gap-3 mt-3">
                    <a href="https://www.instagram.com/arrxfinly_a_s_?igsh=MTRndnJ1eDR0anZwdg==" style="color: #000; font-size: 1.2rem;"><i class='bx bxl-instagram'></i></a>
                    <a href="https://youtube.com/@arraflyaziz2?si=ixyHhTzegNcEvQhP" style="color: #000; font-size: 1.2rem;"><i class='bx bxl-youtube'></i></a>
                    <a href="https://www.tiktok.com/@flyking_bee?_r=1&_t=ZS-92lZ0PAnAcp" style="color: #000; font-size: 1.2rem;"><i class='bx bxl-tiktok'></i></a>
                </div>
            </div>
        </div>

        <div class="form-actual" data-aos="fade-left">
            <form action="<?= base_url('contact/send'); ?>" method="post" id="contactForm">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control-luxe" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="email" name="email" class="form-control-luxe" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Subjek</label>
                    <input type="text" name="subject" class="form-control-luxe" placeholder="Kolaborasi / Bisnis / Lainnya" required>
                </div>

                <div class="form-group">
                    <label>Pesan</label>
                    <textarea name="message" rows="5" class="form-control-luxe" placeholder="Jelaskan kebutuhan Anda..." required></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <span id="btnText">Kirim Sekarang</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Notifikasi Sukses
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                title: 'SUKSES',
                text: '<?= session()->getFlashdata('success'); ?>',
                icon: 'success',
                confirmButtonColor: '#000',
                customClass: {
                    popup: 'rounded-0'
                }
            });
        <?php endif; ?>

        // Loading State
        const form = document.getElementById('contactForm');
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');

        if (form) {
            form.onsubmit = function() {
                btn.disabled = true;
                btnText.innerHTML = 'MENGIRIM...';
                btn.style.opacity = '0.7';
            };
        }
    });
</script>

<?= $this->endSection(); ?>