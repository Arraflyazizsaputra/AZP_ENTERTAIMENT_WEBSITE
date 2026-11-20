<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('admin_content'); ?>

<div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
    <div>
        <h2 class="fw-bold">Artist Roster</h2>
        <p class="text-muted">Manage talent profiles and digital identity.</p>
    </div>
    <button class="btn-azp shadow" data-bs-toggle="modal" data-bs-target="#modalArtist">
        <i class='bx bx-user-plus me-2'></i> Add New Artist
    </button>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <i class='bx bxs-check-circle me-2'></i> <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="card-table">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Artist Name</th>
                    <th>Category</th> <th>Streaming Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($artists as $a): ?>
                <tr>
                    <td>
                        <img src="<?= base_url('img/artists/' . $a['photo']); ?>" class="artist-img" alt="<?= $a['name']; ?>" style="width: 50px; height: 50px; border-radius: 12px; object-fit: cover;">
                    </td>
                    <td>
                        <div class="fw-bold fs-6 text-dark"><?= esc($a['name']); ?></div>
                        <a href="<?= base_url('artists/'.$a['id']); ?>" target="_blank" class="text-warning text-decoration-none small fw-bold">
                            <i class='bx bx-link-external'></i> View
                        </a>
                    </td>
                    <td>
                        <?php 
                            $badgeClass = 'bg-secondary';
                            if($a['category'] == 'soloist') $badgeClass = 'bg-primary';
                            if($a['category'] == 'band') $badgeClass = 'bg-success';
                            if($a['category'] == 'aktor') $badgeClass = 'bg-info';
                        ?>
                        <span class="badge rounded-pill <?= $badgeClass; ?> text-uppercase" style="font-size: 0.7rem;">
                            <?= esc($a['category']); ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <i class='bx bxl-spotify <?= $a['spotify_link'] != '#' ? 'text-success' : 'text-muted opacity-25'; ?> fs-4'></i>
                            <i class='bx bxl-youtube <?= $a['youtube_link'] != '#' ? 'text-danger' : 'text-muted opacity-25'; ?> fs-4'></i>
                            <i class='bx bxl-apple <?= $a['apple_link'] != '#' ? 'text-info' : 'text-muted opacity-25'; ?> fs-4'></i>
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-light btn-sm rounded-pill px-3 fw-bold border" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEditArtist"
                                    onclick="fillEditModal('<?= $a['id']; ?>', '<?= esc($a['name']); ?>', '<?= $a['category']; ?>', '<?= $a['spotify_link']; ?>', '<?= $a['youtube_link']; ?>', '<?= $a['apple_link']; ?>')">
                                <i class='bx bx-edit-alt'></i> Edit
                            </button>
                            
                            <a href="<?= base_url('admin/artists/delete/'.$a['id']); ?>" 
                               class="btn btn-outline-danger btn-sm rounded-pill px-3" 
                               onclick="return confirm('Hapus artis ini?')">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalArtist" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 30px; border: none; padding: 20px;">
            <div class="modal-header border-0">
                <h4 class="fw-bold">New Artist Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <form action="<?= base_url('admin/artists/save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small">Stage Name</label>
                            <input type="text" name="name" class="form-control" style="border-radius: 12px; background: #f9f9f9;" placeholder="e.g. Arraflyaziz" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small">Artist Category</label>
                            <select name="category" class="form-select" style="border-radius: 12px; background: #f9f9f9;" required>
                                <option value="" selected disabled>Select Category</option>
                                <option value="soloist">Singer Soloist</option>
                                <option value="band">Grup Band</option>
                                <option value="aktor">Aktor</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-bold small">Artist Photo</label>
                            <input type="file" name="photo" class="form-control" style="border-radius: 12px;" accept="image/*" required>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 mt-2"><i class='bx bx-link'></i> Streaming Platforms</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">Spotify URL</label>
                            <input type="text" name="spotify_link" class="form-control" style="border-radius: 10px;" value="#">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">YouTube URL</label>
                            <input type="text" name="youtube_link" class="form-control" style="border-radius: 10px;" value="#">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">Apple Music URL</label>
                            <input type="text" name="apple_link" class="form-control" style="border-radius: 10px;" value="#">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn-azp w-100 py-3">Add to Studio Roster</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditArtist" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 30px; border: none; padding: 20px;">
            <div class="modal-header border-0">
                <h4 class="fw-bold">Edit Artist Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" action="" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small">Stage Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" style="border-radius: 12px; background: #f9f9f9;" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small">Artist Category</label>
                            <select name="category" id="edit_category" class="form-select" style="border-radius: 12px; background: #f9f9f9;" required>
                                <option value="soloist">Singer Soloist</option>
                                <option value="band">Grup Band</option>
                                <option value="aktor">Aktor</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-bold small">Change Photo (Optional)</label>
                            <input type="file" name="photo" class="form-control" style="border-radius: 12px;" accept="image/*">
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 mt-2"><i class='bx bx-link'></i> Update Streaming Links</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">Spotify URL</label>
                            <input type="text" name="spotify_link" id="edit_spotify" class="form-control" style="border-radius: 10px;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">YouTube URL</label>
                            <input type="text" name="youtube_link" id="edit_youtube" class="form-control" style="border-radius: 10px;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small fw-bold">Apple Music URL</label>
                            <input type="text" name="apple_link" id="edit_apple" class="form-control" style="border-radius: 10px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn-azp w-100 py-3">Update Identity</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function fillEditModal(id, name, category, spotify, youtube, apple) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_category').value = category; // Set dropdown kategori
        document.getElementById('edit_spotify').value = spotify;
        document.getElementById('edit_youtube').value = youtube;
        document.getElementById('edit_apple').value = apple;
        
        document.getElementById('editForm').action = "<?= base_url('admin/artists/save'); ?>";
    }

    
</script>

<?= $this->endSection(); ?>