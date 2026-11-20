<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentikasi | AZP LABELS</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&family=Montserrat:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --azp-yellow: #FFD700;
            --azp-white: #ffffff;
            --azp-bg: #fdfdfd;
            --azp-dark: #1a1a1a;
            --radius: 40px;
        }

        /* Mengatasi warna background otomatis dari browser */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus {
            -webkit-text-fill-color: var(--azp-dark);
            -webkit-box-shadow: 0 0 0px 1000px #f9f9f9 inset;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* UPDATE: Font default menggunakan Montserrat */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            /* Memanggil gambar dari folder public/img */
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('<?= base_url('img/pagelogin.png'); ?>');
        }

        .container {
            position: relative;
            width: 850px;
            height: 550px;
            background: var(--azp-white);
            border-radius: var(--radius);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-box {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            transition: all 0.6s ease-in-out;
            background: var(--azp-white);
        }

        .form-box.login {
            left: 50%;
            z-index: 2;
            opacity: 1;
        }

        .form-box.register {
            left: 50%;
            z-index: 1;
            opacity: 0;
        }

        .container.active .form-box.login {
            transform: translateX(-100%);
            opacity: 0;
            z-index: 1;
        }

        .container.active .form-box.register {
            transform: translateX(-100%);
            opacity: 1;
            z-index: 5;
        }

        form {
            width: 100%;
            text-align: center;
        }

        /* UPDATE: Brand Title menggunakan OSWALD (Khas YG Entertainment) */
        .brand-title {
            font-family: 'Oswald', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -1px;
            color: var(--azp-dark);
            margin-bottom: 5px;
        }

        .brand-title span {
            color: var(--azp-yellow);
        }

        /* UPDATE: Subtitle lebih bold dan spacing lebar */
        .subtitle {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #999;
            margin-bottom: 35px;
            display: block;
            font-weight: 800;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            background: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 15px;
            outline: none;
            font-size: 0.85rem;
            transition: 0.3s;
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
        }

        .input-group input:focus {
            border-color: var(--azp-yellow);
            background: #fff;
        }

        .input-group i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 20px;
        }

        .input-group input:focus~i {
            color: var(--azp-yellow);
        }

        /* UPDATE: Button menggunakan OSWALD agar terlihat lebih "industri/label" */
        .btn-main {
            width: 100%;
            padding: 15px;
            background: var(--azp-dark);
            color: var(--azp-yellow);
            border: none;
            border-radius: 15px;
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-main:hover {
            background: #000;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .toggle-box {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
            pointer-events: none;
        }

        .toggle-box::before {
            content: '';
            position: absolute;
            left: -250%;
            width: 300%;
            height: 100%;
            background: var(--azp-yellow);
            border-radius: 150px;
            z-index: 2;
            transition: 1.8s ease-in-out;
            pointer-events: all;
        }

        .container.active .toggle-box::before {
            left: 50%;
        }

        .toggle-panel {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: var(--azp-dark);
            z-index: 2;
            transition: 0.6s ease-in-out;
            padding: 0 50px;
            text-align: center;
            pointer-events: all;
        }

        .toggle-left {
            left: 0;
            transition-delay: 1.2s;
        }

        .container.active .toggle-left {
            left: -50%;
            transition-delay: 0.6s;
        }

        .toggle-right {
            right: -50%;
            transition-delay: 0.6s;
        }

        .container.active .toggle-right {
            right: 0;
            transition-delay: 1.2s;
        }

        /* UPDATE: Heading Toggle menggunakan OSWALD Bold */
        .toggle-panel h1 {
            font-family: 'Oswald', sans-serif;
            font-size: 2.5rem;
            text-transform: uppercase;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .toggle-panel p {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: rgba(0, 0, 0, 0.6);
            line-height: 1.6;
        }

        /* UPDATE: Button Toggle menggunakan Oswald */
        .btn-toggle {
            width: 160px;
            height: 48px;
            background: transparent;
            border: 2px solid var(--azp-dark);
            color: var(--azp-dark);
            border-radius: 50px;
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-toggle:hover {
            background: var(--azp-dark);
            color: var(--azp-yellow);
        }

        .alert-msg {
            font-family: 'Montserrat', sans-serif;
            font-size: 11px;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .error {
            color: #d63031;
        }

        .success {
            color: #00b894;
        }

        @media screen and (max-width: 650px) {
            .container {
                width: 95%;
                height: auto;
                border-radius: 20px;
            }

            .toggle-box {
                display: none;
            }

            .form-box {
                width: 100%;
                left: 0 !important;
                position: relative;
                padding: 60px 20px;
                transform: none !important;
            }

            .form-box.register {
                display: none;
            }

            .container.active .form-box.login {
                display: none;
            }

            .container.active .form-box.register {
                display: flex;
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="container <?= session()->getFlashdata('open_register') ? 'active' : ''; ?>" id="container">

        <div class="form-box login">
            <form action="<?= base_url('/login/process'); ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>
                <h1 class="brand-title">AZP<span>.</span>STUDIO</h1>
                <span class="subtitle">Akses Pusat Kontrol</span>

                <?php if (session()->getFlashdata('error')): ?>
                    <p class="alert-msg error"><?= session()->getFlashdata('error') ?></p>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <p class="alert-msg success"><?= session()->getFlashdata('success') ?></p>
                <?php endif; ?>

                <div class="input-group">
                    <i class='bx bxs-user-circle'></i>
                    <input type="text" name="username" placeholder="Nama Pengguna" autocomplete="off" required>
                </div>
                <div class="input-group">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" name="password" placeholder="Kata Sandi" autocomplete="current-password" required>
                </div>
                <button type="submit" class="btn-main">Masuk Ke Studio</button>
            </form>
        </div>

        <div class="form-box register">
            <form action="<?= base_url('/register/save'); ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>
                <h1 class="brand-title">STUDIO<span>.</span>AZP</h1>

                <div class="input-group">
                    <i class='bx bxs-user-plus'></i>
                    <input type="text" name="username" placeholder="Nama Pengguna" autocomplete="off" required>
                </div>
                <div class="input-group">
                    <i class='bx bxs-envelope'></i>
                    <input type="email" name="email" placeholder="Alamat Email" autocomplete="off" required>
                </div>
                <div class="input-group">
                    <i class='bx bxs-key'></i>
                    <input type="password" name="password" placeholder="Buat Kata Sandi" autocomplete="new-password" required>
                </div>
                <button type="submit" class="btn-main">Daftar Sekarang</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Halo, ADMIN!</h1>
                <p>Silahkan Login Untuk Mengatur Management Content</p>
                <button class="btn-toggle" id="registerBtn">Buat Akun</button>
            </div>

            <div class="toggle-panel toggle-right">
                <h1>Selamat Datang!</h1>
                <p>Silahkan Registrasi</p>
                <button class="btn-toggle" id="loginBtn">Masuk</button>
            </div>
        </div>

    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('registerBtn');
        const loginBtn = document.getElementById('loginBtn');

        registerBtn.addEventListener('click', () => {
            container.classList.add('active');
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove('active');
        });
    </script>
</body>

</html>