<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<style>
    /* --- Table Design --- */
    .admin-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        border: none;
        overflow: hidden;
    }

    .table thead th {
        background: #fcfcfc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        font-weight: 700;
        color: #a0a0a0;
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #fffdf0;
        /* Subtle yellow glow */
    }

    .table td {
        padding: 20px;
        border-bottom: 1px solid #f8f8f8;
    }

    /* --- Artist Info --- */
    .artist-img {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 2px solid #fff;
    }

    /* --- Badges --- */
    .badge-status {
        padding: 8px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.7rem;
        letter-spacing: 0.5px;
    }

    .status-filled {
        background: #e8f5e9 !important;
        color: #2e7d32 !important;
    }

    .status-empty {
        background: #ffebee !important;
        color: #c62828 !important;
    }

    /* --- Social Icons Preview --- */
    .social-preview-box {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 1.1rem;
        background: #f8f9fa;
        transition: 0.3s;
    }

    .social-active {
        color: #FFD700;
        background: #1a1a1a;
    }

    /* --- Modal & Form --- */
    .modal-content {
        border-radius: 25px;
        border: none;
    }

    .form-label {
        color: #4a4a4a;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #ececec;
        padding: 12px 18px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #FFD700;
        box-shadow: 0 0 0 0.25rem rgba(255, 215, 0, 0.1);
        background: #fff;
    }

    .btn-update {
        background: #1a1a1a;
        color: #FFD700;
        transition: all 0.3s;
        border: none;
    }

    .btn-update:hover {
        background: #FFD700;
        color: #1a1a1a;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(255, 215, 0, 0.2);
    }

    /* --- Responsive Fix --- */
    @media (max-width: 768px) {
        .mb-4 h2 {
            font-size: 1.5rem;
        }

        .table thead {
            display: none;
        }

        .table td {
            display: block;
            text-align: right;
            padding: 10px 20px;
        }

        .table td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.7rem;
            color: #aaa;
        }

        .text-end {
            text-align: center !important;
            margin-top: 10px;
        }
    }

    /* --- Gaya Tambahan untuk Discography Admin --- */
    .nav-pills .nav-link {
        color: #666;
        font-weight: 600;
        border-radius: 12px;
        padding: 12px 20px;
    }

    .nav-pills .nav-link.active {
        background: #1a1a1a;
        color: #FFD700;
    }

    .album-admin-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 10px;
        border: 1px solid #eee;
        transition: 0.3s;
    }

    .album-admin-card:hover {
        border-color: #FFD700;
    }

    .album-admin-preview {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 10px;
    }

    .btn-delete-album {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 5px 8px;
        font-size: 0.8rem;
    }
</style>

<div class="container-fluid py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-extrabold" style="letter-spacing: -1px;">Artist Profile & Discography</h2>
            <p class="text-muted">Kelola biografi, sosial media, dan katalog album artis.</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <div class="admin-card">
        <div class="table-responsive">
            <table class="table align-middle m-0">
                <thead>
                    <tr>
                        <th>Artist</th>
                        <th>Bio Status</th>
                        <th>Discography</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artists as $a): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="<?= base_url('img/artists/' . $a['photo']); ?>" class="artist-img">
                                    <span class="fw-bold"><?= esc($a['name']); ?></span>
                                </div>
                            </td>
                            <td>
                                <?= empty($a['description']) ? '<span class="badge badge-status status-empty">EMPTY</span>' : '<span class="badge badge-status status-filled">READY</span>'; ?>
                            </td>
                            <td>
                                <span class="badge bg-dark text-warning rounded-pill px-3">
                                    <i class='bx bx-album me-1'></i>
                                    <?= $a['album_count'] ?? 0; ?> Albums
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-dark btn-sm rounded-pill px-4 fw-bold"
                                    onclick="openEditProfileModal(
        <?= $a['id']; ?>, 
        '<?= addslashes(esc($a['name'])); ?>', 
        '<?= base64_encode($a['description']); ?>', 
        '<?= $a['ig_link']; ?>', 
        '<?= $a['tiktok_link']; ?>', 
        '<?= $a['x_link']; ?>', 
        '<?= $a['fb_link']; ?>'
    )">
                                    <i class='bx bx-cog me-1'></i> Manage Profile
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h4 class="fw-bold">Artist: <span id="target_name" class="text-warning"></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <ul class="nav nav-pills mb-4 bg-light p-2 rounded-4" id="pills-tab" role="tablist">
                    <li class="nav-item flex-fill text-center">
                        <button class="nav-link active w-100" data-bs-toggle="pill" data-bs-target="#tab-bio">Bio & Socials</button>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <button class="nav-link w-100" data-bs-toggle="pill" data-bs-target="#tab-disco" onclick="loadDiscography()">Discography (Albums)</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-bio">
                        <form action="<?= base_url('admin/profiles/save'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id" id="target_id">

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase">Biography</label>
                                <textarea name="description" id="target_desc" class="form-control rounded-4" rows="5" placeholder="Tulis biografi artis di sini..."></textarea>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="small fw-bold"><i class='bx bxl-instagram'></i> Instagram URL</label>
                                    <input type="url" name="ig_link" id="target_ig" class="form-control rounded-3" placeholder="https://instagram.com/...">
                                </div>
                                <div class="col-md-6">
                                    <label class="small fw-bold"><i class='bx bxl-tiktok'></i> TikTok URL</label>
                                    <input type="url" name="tiktok_link" id="target_tiktok" class="form-control rounded-3" placeholder="https://tiktok.com/@...">
                                </div>
                                <div class="col-md-6">
                                    <label class="small fw-bold"><i class='bx bxl-twitter'></i> X (Twitter) URL</label>
                                    <input type="url" name="x_link" id="target_x" class="form-control rounded-3" placeholder="https://x.com/...">
                                </div>
                                <div class="col-md-6">
                                    <label class="small fw-bold"><i class='bx bxl-facebook'></i> Facebook URL</label>
                                    <input type="url" name="fb_link" id="target_fb" class="form-control rounded-3" placeholder="https://facebook.com/...">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark w-100 py-3 mt-4 fw-bold rounded-pill text-warning">
                                <i class='bx bx-save'></i> SAVE CHANGES
                            </button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="tab-disco">
                        <div class="p-3 border rounded-4 bg-light mb-4">
                            <h6 class="fw-bold mb-3"><i class='bx bx-plus-circle'></i> Add New Album</h6>
                            <form action="<?= base_url('admin/discography/add'); ?>" method="post" enctype="multipart/form-data" class="row g-2">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="artist_id" id="disco_artist_id">
                                <div class="col-md-4">
                                    <input type="text" name="album_title" class="form-control form-control-sm" placeholder="Album Title" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="youtube_url" class="form-control form-control-sm" placeholder="YouTube Link" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="album_cover" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning btn-sm w-100 fw-bold">UPLOAD ALBUM</button>
                                </div>
                            </form>
                        </div>

                        <h6 class="fw-bold mb-3">Album Collection</h6>
                        <div id="disco-list" class="row g-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentArtistId = null;

    function openEditProfileModal(id, name, base64Desc, ig, tiktok, x, fb) {
        currentArtistId = id;
        document.getElementById('target_id').value = id;
        document.getElementById('disco_artist_id').value = id;
        document.getElementById('target_name').innerText = name;

        // Decode Base64 kembali menjadi teks biasa
        try {
            document.getElementById('target_desc').value = atob(base64Desc);
        } catch (e) {
            document.getElementById('target_desc').value = ""; // Jika kosong/error
        }

        document.getElementById('target_ig').value = ig;
        document.getElementById('target_tiktok').value = tiktok;
        document.getElementById('target_x').value = x;
        document.getElementById('target_fb').value = fb;

        new bootstrap.Modal(document.getElementById('profileModal')).show();
    }

    function loadDiscography() {
        const discoList = document.getElementById('disco-list');
        discoList.innerHTML = '<div class="text-center p-4"><div class="spinner-border text-warning"></div></div>';

        fetch('<?= base_url('admin/discography/get/'); ?>' + currentArtistId)
            .then(res => res.json())
            .then(data => {
                discoList.innerHTML = '';
                if (data.length === 0) {
                    discoList.innerHTML = '<p class="text-center text-muted py-4">No albums found.</p>';
                    return;
                }
                data.forEach(album => {
                    discoList.innerHTML += `
                    <div class="col-4 col-md-3">
                        <div class="album-admin-card position-relative text-center">
                            <button onclick="deleteAlbum(${album.id})" class="btn-delete-album"><i class='bx bx-trash'></i></button>
                            <img src="<?= base_url('img/discography/'); ?>/${album.album_cover}" class="album-admin-preview mb-2">
                            <p class="small fw-bold m-0 text-truncate">${album.album_title}</p>
                        </div>
                    </div>`;
                });
            });
    }

    function deleteAlbum(id) {
        if (confirm('Delete this album?')) {
            window.location.href = '<?= base_url('admin/discography/delete/'); ?>' + id;
        }
    }
</script>

<?= $this->endSection(); ?>