<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="fw-bold"><i class='bx bx-info-circle me-2'></i>About Us Management</h2>
        <p class="text-muted">Kelola seluruh informasi perusahaan dan penghargaan.</p>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show rounded-pill px-4" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <ul class="nav nav-pills nav-fill bg-light rounded-pill p-1" id="aboutTab" role="tablist">
                <li class="nav-item"><button class="nav-link active rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#general">General</button></li>
                <li class="nav-item"><button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#vision">Vision</button></li>
                <li class="nav-item"><button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#leader">CEO</button></li>
                <li class="nav-item"><button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#awards">Awards</button></li>
                <li class="nav-item"><button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#location">Location</button></li>
            </ul>
        </div>

        <form action="<?= base_url('admin/about/save'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="general">
                        <h5 class="fw-bold mb-4">Building & Philosophy</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold mb-1">Building Image (Hero)</label>
                                <input type="file" name="building_img" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="small fw-bold mb-1">Philosophy</label>
                                <textarea name="philosophy" class="form-control" rows="4"><?= $profile['philosophy'] ?? ''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="vision">
                        <h5 class="fw-bold mb-4">Vision & Mission</h5>
                        <input type="text" name="vision" class="form-control mb-3" value="<?= $profile['vision'] ?? ''; ?>" placeholder="Vision Title">
                        <div class="row">
                            <div class="col-md-4"><textarea name="mission_1" class="form-control" rows="3"><?= $profile['mission_1'] ?? ''; ?></textarea></div>
                            <div class="col-md-4"><textarea name="mission_2" class="form-control" rows="3"><?= $profile['mission_2'] ?? ''; ?></textarea></div>
                            <div class="col-md-4"><textarea name="mission_3" class="form-control" rows="3"><?= $profile['mission_3'] ?? ''; ?></textarea></div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="leader">
                        <h5 class="fw-bold mb-4">CEO Bio</h5>
                        <div class="row">
                            <div class="col-md-4"><input type="file" name="ceo_img" class="form-control"></div>
                            <div class="col-md-8">
                                <input type="text" name="ceo_name" class="form-control mb-2" value="<?= $profile['ceo_name'] ?? ''; ?>">
                                <textarea name="ceo_bio" class="form-control" rows="4"><?= $profile['ceo_bio'] ?? ''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="awards">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold m-0">Award Badges</h5>
                            <button type="button" class="btn btn-dark rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addAwardModal">
                                <i class='bx bx-plus'></i> Add New Award Photo
                            </button>
                        </div>
                        <div class="row g-3">
                            <?php if (!empty($awards)) : foreach ($awards as $aw) : ?>
                            <div class="col-md-3">
                                <div class="card p-3 border text-center shadow-sm">
                                    <img src="<?= base_url('img/awards/' . $aw['icon']); ?>" class="mx-auto mb-2 rounded" style="width: 80px; height: 80px; object-fit: contain;">
                                    <div class="small fw-bold text-uppercase"><?= $aw['name']; ?></div>
                                    <a href="<?= base_url('admin/about/delete-award/' . $aw['id']); ?>" class="btn btn-sm btn-outline-danger mt-2 border-0" onclick="return confirm('Hapus foto penghargaan ini?')">
                                        <i class='bx bx-trash'></i> Remove
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; else : ?>
                                <p class="text-center text-muted">Belum ada foto penghargaan.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="location">
                        <h5 class="fw-bold mb-4">Office & Maps</h5>
                        <textarea name="address" class="form-control mb-3" rows="3"><?= $profile['address'] ?? ''; ?></textarea>
                        <input type="text" name="maps_link" class="form-control" value="<?= $profile['maps_link'] ?? ''; ?>" placeholder="Paste Google Maps Embed URL Here">
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-light border-0 p-4 text-end">
                <button type="submit" class="btn btn-warning px-5 fw-bold rounded-pill">SAVE ALL CHANGES</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="addAwardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="<?= base_url('admin/about/add-award'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Add Award Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Award Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="Contoh: Best Production 2025">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Award Image / Badge</label>
                        <input type="file" name="icon" class="form-control" required>
                        <small class="text-muted">Gunakan file PNG transparan untuk hasil terbaik.</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold">Upload Award</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>