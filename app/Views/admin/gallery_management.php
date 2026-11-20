<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold">Visual Gallery</h2>
            <p class="text-muted">Kelola koleksi foto studio dan dokumentasi kegiatan.</p>
        </div>
        <button class="btn btn-azp shadow" data-bs-toggle="modal" data-bs-target="#addGalleryModal" style="background: var(--azp-yellow); border-radius: 12px; font-weight: 700; padding: 12px 25px;">
            <i class='bx bx-plus-circle me-2'></i> Add New Photo
        </button>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class='bx bxs-check-circle me-2'></i> <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php foreach ($gallery as $g) : ?>
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div style="height: 200px; overflow: hidden;">
                        <img src="<?= base_url('img/gallery/' . $g['image']); ?>" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold mb-1 text-truncate"><?= esc($g['title']); ?></h6>
                        <p class="text-muted small mb-3 text-truncate"><?= esc($g['description']); ?></p>
                        <div class="d-grid">
                            <a href="<?= base_url('admin/gallery/delete/' . $g['id']); ?>" 
                               class="btn btn-outline-danger btn-sm rounded-pill" 
                               onclick="return confirm('Hapus foto ini dari galeri?')">
                                <i class='bx bx-trash me-1'></i> Delete Photo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($gallery)) : ?>
            <div class="col-12 text-center py-5">
                <i class='bx bx-image-add display-1 text-muted opacity-25'></i>
                <p class="text-muted mt-3">Belum ada foto di galeri studio.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="addGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="modal-title fw-bold">Upload to Gallery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/gallery/save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Photo Title</label>
                        <input type="text" name="title" class="form-control rounded-3" placeholder="Contoh: Studio Session Vol.1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Short Description</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Ceritakan sedikit tentang foto ini..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Image</label>
                        <input type="file" name="image" class="form-control rounded-3" accept="image/*" required>
                        <small class="text-muted">Rekomendasi ukuran: 1:1 atau 4:3 (Maks 2MB)</small>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="submit" class="btn btn-warning w-100 fw-bold py-3 rounded-pill shadow-sm">UPLOAD TO GALLERY</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>