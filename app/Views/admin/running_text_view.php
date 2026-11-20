<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<div class="container-fluid">
    <div class="mb-4">
        <h2 class="fw-bold">Manage Running Text</h2>
        <p class="text-muted">Kelola teks berjalan di halaman depan. Gunakan tanda koma ( , ) sebagai pemisah antar nama.</p>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 px-4 py-3 d-flex align-items-center">
            <i class='bx bxs-check-circle me-3 fs-4'></i>
            <div><?= session()->getFlashdata('success'); ?></div>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php foreach ($running_texts as $rt) : ?>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 transition-hover">
                <form action="<?= base_url('admin/running-text/save'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $rt['id']; ?>">
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                            <i class='bx bx-text text-warning fs-4'></i>
                        </div>
                        <h5 class="fw-bold text-uppercase m-0" style="font-size: 0.9rem; letter-spacing: 1px;">
                            <?= $rt['category']; ?> Line
                        </h5>
                    </div>

                    <div class="mb-4">
                        <label class="small fw-bold text-muted mb-2">Content List</label>
                        <textarea name="content" class="form-control border-0 shadow-none" rows="5" 
                                  style="border-radius: 15px; background: #f8f9fa; font-size: 0.9rem;" 
                                  placeholder="Contoh: NAMA 1, NAMA 2, NAMA 3..."><?= $rt['content']; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 rounded-pill fw-bold py-2 shadow-sm">
                        <i class='bx bx-save me-2'></i> UPDATE <?= strtoupper($rt['category']); ?>
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
    }
</style>

<?= $this->endSection(); ?>