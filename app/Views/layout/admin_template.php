<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard'; ?> | AZP STUDIO Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        :root {
            --azp-yellow: #FFD700;
            --azp-yellow-dark: #e6c200;
            --azp-white: #ffffff;
            --azp-bg: #f4f7fa;
            --azp-dark: #121212;
            --azp-grey: #747d8c;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 90px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background: var(--azp-bg);
            font-family: 'Montserrat', sans-serif;
            color: var(--azp-dark);
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--azp-white);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1050;
            transition: var(--transition);
            padding: 25px 15px;
            display: flex;
            flex-direction: column;
        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .brand-logo {
            margin-bottom: 30px;
            text-align: center;
        }

        .admin-logo-img {
            height: 45px;
            width: auto;
            transition: var(--transition);
            object-fit: contain;
        }

        #sidebar.collapsed .admin-logo-img {
            height: 30px;
        }

        #sidebar-nav {
            flex-grow: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
        }

        /* Custom Scrollbar */
        #sidebar-nav::-webkit-scrollbar { width: 4px; }
        #sidebar-nav::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }

        .user-info {
            background: #fcfcfc;
            padding: 12px;
            border-radius: 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid #f0f0f0;
            transition: var(--transition);
        }

        #sidebar.collapsed .user-info {
            padding: 10px;
            justify-content: center;
            background: transparent;
            border-color: transparent;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--azp-dark);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--azp-yellow);
            flex-shrink: 0;
        }

        .nav-label {
            font-size: 0.65rem;
            font-weight: 800;
            color: #bdc3c7;
            text-transform: uppercase;
            margin: 20px 0 10px 15px;
            letter-spacing: 1.5px;
            transition: opacity 0.3s;
        }

        #sidebar.collapsed .nav-label { opacity: 0; }

        .nav-link-admin {
            color: var(--azp-grey);
            padding: 12px 15px;
            display: flex;
            align-items: center;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 0.88rem;
            transition: var(--transition);
        }

        .nav-link-admin i {
            min-width: 35px;
            font-size: 1.3rem;
        }

        #sidebar.collapsed .nav-link-admin span,
        #sidebar.collapsed .badge {
            display: none;
        }

        #sidebar.collapsed .nav-link-admin {
            justify-content: center;
            padding: 12px 0;
        }

        .nav-link-admin.active {
            background: var(--azp-dark);
            color: var(--azp-yellow);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .nav-link-admin:hover:not(.active) {
            background: #fffdf0;
            color: var(--azp-dark);
            transform: translateX(5px);
        }

        #sidebar.collapsed .nav-link-admin:hover:not(.active) {
            transform: scale(1.1);
        }

        /* --- CONTENT WRAPPER --- */
        #content-wrapper {
            margin-left: var(--sidebar-width);
            transition: var(--transition);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #content-wrapper.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .top-navbar {
            height: 75px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        #menu-toggle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-radius: 10px;
            font-size: 1.4rem;
            cursor: pointer;
            border: 1px solid #eee;
            transition: 0.3s;
        }

        #menu-toggle:hover {
            background: var(--azp-dark);
            color: var(--azp-yellow);
        }

        .main-content {
            padding: 30px;
            flex-grow: 1;
        }

        /* Mobile Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
            backdrop-filter: blur(3px);
        }

        .sidebar-overlay.show { display: block; }

        @media (max-width: 992px) {
            #sidebar { left: -100%; width: var(--sidebar-width) !important; }
            #sidebar.active-mobile { left: 0; }
            #content-wrapper { margin-left: 0 !important; }
            #sidebar.collapsed .nav-link-admin span { display: block; } /* Reset for mobile */
        }
    </style>
</head>

<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside id="sidebar">
        <div class="brand-logo">
            <a href="<?= base_url('admin/dashboard'); ?>">
                <img src="<?= base_url('img/lOGO.png'); ?>" alt="AZP STUDIO" class="admin-logo-img">
            </a>
        </div>

        <div class="user-info">
            <div class="user-avatar">AD</div>
            <div class="user-details overflow-hidden">
                <p class="m-0 fw-bold small text-nowrap">Administrator</p>
                <p class="m-0 text-muted" style="font-size: 0.65rem;">Super Access</p>
            </div>
        </div>

        <nav id="sidebar-nav">
            <p class="nav-label">General</p>
            <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link-admin <?= url_is('admin/dashboard') ? 'active' : ''; ?>" title="Dashboard">
                <i class='bx bxs-dashboard'></i> <span>Dashboard</span>
            </a>

            <p class="nav-label">Core Content</p>
            <a href="<?= base_url('admin/artists'); ?>" class="nav-link-admin <?= url_is('admin/artists*') ? 'active' : ''; ?>" title="Artists Roster">
                <i class='bx bxs-microphone-alt'></i> <span>Artists Roster</span>
            </a>
            
            <a href="<?= base_url('admin/profiles'); ?>" class="nav-link-admin <?= url_is('admin/profiles*') ? 'active' : ''; ?>" title="Artist Profiles">
                <i class="bx bx-user-pin"></i> <span>Artist Profiles</span>
            </a>

            <a href="<?= base_url('admin/albums'); ?>" class="nav-link-admin <?= url_is('admin/albums*') ? 'active' : ''; ?>" title="Album Gallery">
                <i class='bx bxs-layer'></i> <span>Album Gallery</span>
            </a>
            <a href="<?= base_url('admin/gallery'); ?>" class="nav-link-admin <?= url_is('admin/gallery*') ? 'active' : ''; ?>" title="Studio Gallery">
                <i class='bx bxs-image'></i> <span>Studio Gallery</span>
            </a>

            <p class="nav-label">Recruitment</p>
            <a href="<?= base_url('admin/auditions'); ?>" class="nav-link-admin <?= url_is('admin/auditions*') ? 'active' : ''; ?>" title="Auditions">
                <i class='bx bxs-megaphone'></i> <span>Auditions</span>
            </a>
                <a href="<?= base_url('admin/applications'); ?>" class="nav-link-admin <?= url_is('admin/applications*') ? 'active' : ''; ?>" title="Applicants">
                <i class='bx bxs-user-detail'></i>
                <span>Applicants</span>
                <span class="badge bg-danger rounded-pill ms-auto">NEW</span>
            </a>

            <a href="<?= base_url('admin/opportunities'); ?>" class="nav-link-admin <?= url_is('admin/opportunities*') ? 'active' : ''; ?>" title="Opportunities">
                <i class='bx bxs-briefcase-alt-2'></i> <span>Opportunities</span>
            </a>
            <p class="nav-label">Interaction</p>
            <a href="<?= base_url('admin/inquiries'); ?>" class="nav-link-admin <?= url_is('admin/inquiries*') ? 'active' : ''; ?>" title="Messages">
                <i class='bx bxs-envelope'></i> <span>Messages</span>
            </a>

            <p class="nav-label">Settings</p>
            <a href="<?= base_url('admin/about'); ?>" class="nav-link-admin <?= url_is('admin/about*') ? 'active' : ''; ?>" title="Agency Info">
                <i class='bx bxs-info-circle'></i> <span>Agency Info</span>
            </a>
            <a href="<?= base_url('admin/running-text'); ?>" class="nav-link-admin <?= url_is('admin/running-text*') ? 'active' : ''; ?>" title="Running Text">
    <i class='bx bx-text'></i> <span>Running Text</span>
</a>
        </nav>

        <div class="mt-auto pt-3 border-top">
            <a href="javascript:void(0)" id="logout-btn" class="nav-link-admin text-danger" title="Sign Out">
                <i class='bx bx-power-off'></i> <span>Sign Out</span>
            </a>
        </div>
    </aside>

    <div id="content-wrapper">
        <header class="top-navbar">
            <div class="d-flex align-items-center">
                <div id="menu-toggle"><i class='bx bx-menu-alt-left'></i></div>
                <div class="ms-3 d-none d-md-block">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0" style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">
                            <li class="breadcrumb-item text-muted">System</li>
                            <li class="breadcrumb-item active text-dark"><?= str_replace('Manage ', '', $title ?? 'Admin'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-light text-dark border rounded-pill d-none d-sm-block px-3 py-2">
                    <i class='bx bx-calendar me-1'></i> <?= date('d M Y') ?>
                </span>
                <a href="<?= base_url('/'); ?>" target="_blank" rel="noopener" class="btn btn-sm btn-dark rounded-pill px-3">VIEW HOME</a>
            </div>
        </header>

        <main class="main-content">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center alert-dismissible fade show" role="alert">
                    <i class='bx bxs-check-circle fs-4 me-2'></i>
                    <div><?= session()->getFlashdata('success'); ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center alert-dismissible fade show" role="alert">
                    <i class='bx bxs-error-circle fs-4 me-2'></i>
                    <div><?= session()->getFlashdata('error'); ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('admin_content'); ?>
        </main>

   
    </div>
     <footer class="px-4 py-4 mt-auto border-top bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-end">
                <p class="m-0 small text-muted">
                    &copy; <?= date('Y') ?> <span class="fw-bold text-dark" style="letter-spacing: 1px;">AZP STUDIO ENTERTAINMENT</span> 
                    <span class="mx-2 text-light">|</span> 
                    <span class="badge bg-light text-dark border fw-normal" style="font-size: 0.65rem;">CODEIGNITURE 4.0</span>
                </p>
                <p class="m-0 mt-1 small text-muted" style="letter-spacing: 0.5px;">
                    Dibuat oleh <strong class="text-dark">Arrafly Aziz Saputra</strong> 
                    <span class="ms-1 text-dark" title="Semangat Membara">dengan semangat yang membara 😡</span>
                </p>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const contentWrapper = document.getElementById('content-wrapper');
        const overlay = document.getElementById('sidebarOverlay');

        // Toggle Sidebar Logic
        menuToggle.addEventListener('click', () => {
            if (window.innerWidth > 992) {
                sidebar.classList.toggle('collapsed');
                contentWrapper.classList.toggle('expanded');
            } else {
                sidebar.classList.add('active-mobile');
                overlay.classList.add('show');
            }
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active-mobile');
            overlay.classList.remove('show');
        });

        // Logout Logic Optimized
        document.getElementById('logout-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Waduh, Mau Kabur Bos? 🏃‍♂️',
                text: "Yakin mau ninggalin AZP Studio sekarang? Artis-artis nungguin lho!",
                icon: 'question',
                background: '#121212',
                color: '#ffffff',
                showCancelButton: true,
                confirmButtonColor: '#FFD700',
                cancelButtonColor: '#333333',
                confirmButtonText: 'Iya, Cabut Dulu!',
                cancelButtonText: 'Gak Jadi',
                reverseButtons: true,
                borderRadius: '15px'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sampai Jumpa!',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                        background: '#121212',
                        color: '#ffffff'
                    }).then(() => {
                        window.location.href = "<?= base_url('logout'); ?>";
                    });
                }
            })
        });
    </script>
</body>
</html>