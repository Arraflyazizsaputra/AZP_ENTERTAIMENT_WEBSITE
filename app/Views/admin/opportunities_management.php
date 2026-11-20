<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4 text-uppercase">Opportunities Management</h2>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 rounded-4"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold m-0">PARTNERS & SPONSORS</h5>
                    <button class="btn btn-dark btn-sm rounded-pill px-3" onclick="addSponsor()">+ ADD LOGO</button>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="small text-muted">
                                    <th>LOGO</th>
                                    <th>NAME</th>
                                    <th class="text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sponsors as $s): ?>
                                <tr>
                                    <td><img src="<?= base_url('img/sponsors/'.$s['logo']); ?>" height="30"></td>
                                    <td class="small fw-bold"><?= $s['name']; ?></td>
                                    <td class="text-end">
                                        <a href="<?= base_url('admin/opportunities/delete-sponsor/'.$s['id']); ?>" class="text-danger" onclick="return confirm('Hapus?')"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold m-0">CAREER OPENINGS</h5>
                    <button class="btn btn-dark btn-sm rounded-pill px-3" onclick="addCareer()">+ ADD JOB</button>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="small text-muted">
                                    <th>POSITION</th>
                                    <th>CATEGORY</th>
                                    <th class="text-end">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($careers as $c): ?>
                                <tr>
                                    <td class="small fw-bold"><?= $c['title']; ?></td>
                                    <td class="small text-muted"><?= $c['category']; ?></td>
                                    <td class="text-end">
                                        <a href="<?= base_url('admin/opportunities/delete-career/'.$c['id']); ?>" class="text-danger" onclick="return confirm('Hapus?')"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSponsor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/opportunities/save-sponsor'); ?>" method="post" enctype="multipart/form-data" class="modal-content border-0 shadow-lg rounded-4">
            
            <?= csrf_field(); ?> <div class="modal-body p-4">
                <h5 class="fw-bold mb-3">ADD PARTNER LOGO</h5>
                <div class="mb-3">
                    <label class="small fw-bold">BRAND NAME</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="small fw-bold">LOGO (PNG/SVG RECOMMENDED)</label>
                    <input type="file" name="logo" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">SAVE PARTNER</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalCareer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/opportunities/save-career'); ?>" method="post" class="modal-content border-0 shadow-lg rounded-4">
            
            <?= csrf_field(); ?> <div class="modal-body p-4">
                <h5 class="fw-bold mb-3">ADD CAREER INFO</h5>
                <div class="mb-3">
                    <label class="small fw-bold">JOB TITLE</label>
                    <input type="text" name="title" class="form-control" placeholder="E.g. Senior Sound Engineer" required>
                </div>
                <div class="mb-3">
                    <label class="small fw-bold">CATEGORY / LOCATION</label>
                    <input type="text" name="category" class="form-control" placeholder="E.g. Creative / Remote" required>
                </div>
                <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">SAVE JOB INFO</button>
            </div>
        </form>
    </div>
</div>

<script>
    function addSponsor() { new bootstrap.Modal(document.getElementById('modalSponsor')).show(); }
    function addCareer() { new bootstrap.Modal(document.getElementById('modalCareer')).show(); }
</script>

<?= $this->endSection(); ?>