<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Oswald:wght@400;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --accent-color: #000000;
        --secondary-color: #888888;
        --accent-red: #e11c24;
        --cb-luxe: cubic-bezier(0.23, 1, 0.32, 1);
        --font-heading: 'Oswald', sans-serif;
        --font-body: 'Montserrat', sans-serif;
    }

    .apply-wrapper {
        padding: 180px 5% 120px;
        max-width: 1000px;
        margin: 0 auto;
        font-family: var(--font-body);
    }

    /* Header Styling */
    .apply-header {
        margin-bottom: 80px;
        position: relative;
    }

    .selected-audition {
        font-family: var(--font-body);
        display: inline-block;
        padding: 6px 15px;
        background: var(--accent-red);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 25px;
        border-radius: 0px;
        /* YG cenderung kotak tajam */
    }

    .apply-header h1 {
        font-family: var(--font-heading);
        font-size: clamp(2.5rem, 8vw, 5rem);
        text-transform: uppercase;
        letter-spacing: 0.02em;
        /* Oswald butuh sedikit spacing rapat */
        line-height: 1.1;
        margin: 0 0 20px 0;
        font-weight: 700;
    }

    .apply-header p {
        font-family: var(--font-body);
        font-size: 1rem;
        max-width: 600px;
        line-height: 1.6;
        color: var(--secondary-color);
        font-weight: 400;
    }

    /* Form Design */
    .apply-form {
        background: #ffffff;
        position: relative;
    }

    .form-group {
        position: relative;
        margin-bottom: 50px;
    }

    .apply-form label {
        font-family: var(--font-body);
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.2em;
        margin-bottom: 12px;
        color: var(--accent-color);
        text-transform: uppercase;
    }

    .apply-form input,
    .apply-form textarea {
        font-family: var(--font-body);
        width: 100%;
        padding: 15px 0;
        border: none;
        border-bottom: 2px solid #e0e0e0;
        outline: none;
        font-size: 1.1rem;
        background: transparent;
        transition: all 0.4s var(--cb-luxe);
        border-radius: 0;
        font-weight: 400;
    }

    .apply-form input:focus,
    .apply-form textarea:focus {
        border-color: var(--accent-color);
        padding-left: 10px;
    }

    .apply-form input::placeholder {
        font-family: var(--font-body);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Submit Button */
    .btn-submit-app {
        font-family: var(--font-body);
        background: var(--accent-color);
        color: #fff;
        border: none;
        padding: 25px 0;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        cursor: pointer;
        transition: all 0.5s var(--cb-luxe);
        width: 100%;
    }

    .btn-submit-app:hover {
        background: #222;
        letter-spacing: 6px;
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .apply-wrapper {
            padding-top: 140px;
        }

        .apply-header h1 {
            font-size: 3.5rem;
        }

        .col-md-6 {
            margin-bottom: 0;
        }
    }
</style>

<div class="apply-wrapper">
    <div class="apply-header" data-aos="fade-up">
        <span class="selected-audition">
            <?= esc($audition['category']); ?> / <?= esc($audition['title']); ?>
        </span>
        <h1>SIAPA<br>BINTANG SELANJUTNYA<span>.</span></h1>
        <p>Tunjukkan bakat terbaik Anda. Tim casting kami meninjau setiap Portofolio bakat anda secara mendalam.</p>
    </div>

    <form action="<?= base_url('auditions/submit'); ?>" method="post" class="apply-form" id="formAudition" data-aos="fade-up" data-aos-delay="200">
        <?= csrf_field(); ?>
        <input type="hidden" name="audition_id" value="<?= $audition['id']; ?>">

        <div class="row g-md-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="YOUR LEGAL NAME" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="CONTACT@EMAIL.COM" required>
                </div>
            </div>
        </div>

        <div class="row g-md-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone / WhatsApp</label>
                    <input type="text" name="phone" placeholder="+62 ..." required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Portfolio / Video Link</label>
                    <input type="url" name="portfolio_link" placeholder="YOUTUBE, DRIVE, OR VIMEO LINK" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Biography & Experience</label>
            <textarea name="message" placeholder="BERITAHU KAMI TENTANG PENGALAMAN DAN MOTIVASI ANDA..." rows="3"></textarea>
        </div>

        <button type="submit" class="btn-submit-app shadow-lg" id="submitBtn">
            <span id="btnText">Submit Application</span>
        </button>
    </form>
</div>



<script>
    // 1. Notifikasi Sukses dari Flashdata (Setelah Redirect)
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'PENDAFTARAN BERHASIL!!!!',
            text: 'Formulir Anda telah terkirim. Silakan tunggu feedback selanjutnya melalui email atau WhatsApp.',
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

    // 2. Notifikasi Error (Jika ada kendala)
    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            title: 'OOPS!',
            text: '<?= session()->getFlashdata('error'); ?>',
            icon: 'error',
            confirmButtonColor: '#000'
        });
    <?php endif; ?>

    // 3. Loading State pada Button saat Submit
    const form = document.getElementById('formAudition');
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');

    form.onsubmit = function() {
        btn.disabled = true;
        btnText.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i> SENDING...';
        btn.style.opacity = '0.7';
    };

    document.addEventListener('DOMContentLoaded', function() {
        // 1. Notifikasi Error (Tetap di sini karena pakai redirect back)
        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: 'OOPS!',
                text: '<?= session()->getFlashdata('error'); ?>',
                icon: 'error',
                confirmButtonColor: '#000'
            });
        <?php endif; ?>

        // 2. Loading State pada Button saat Submit
        const form = document.getElementById('formAudition');
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');

        if (form) {
            form.onsubmit = function() {
                btn.disabled = true;
                if (btnText) {
                    btnText.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i> SENDING...';
                }
                btn.style.opacity = '0.7';
            };
        }
    });
</script>

<?= $this->endSection(); ?>