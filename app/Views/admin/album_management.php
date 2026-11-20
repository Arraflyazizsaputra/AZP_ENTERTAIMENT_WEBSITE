<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('admin_content'); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1"><i class='bx bx-images me-2'></i>Album Gallery</h2>
            <p class="text-muted small">Kelola visual Swiper Cube halaman depan.</p>
        </div>
        <button type="button" class="btn btn-dark px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#addAlbumModal">
            <i class='bx bx-plus-circle me-1'></i> Add New Slide
        </button>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" width="150">Preview</th>
                            <th>Heading Title</th>
                            <th>Artist & Sub-info</th>
                            <th>Target Link</th> <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($albums)) : ?>
                            <?php foreach ($albums as $a) : ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="rounded-3 overflow-hidden border" style="width: 100px; height: 60px;">
                                            <img src="<?= base_url('img/albums/' . $a['image_path']); ?>" class="w-100 h-100" style="object-fit: cover;">
                                        </div>
                                    </td>
                                    <td><span class="fw-bold text-dark"><?= $a['title']; ?></span></td>
                                    <td>
                                        <div class="small fw-bold text-dark"><?= $a['artist_name']; ?></div>
                                        <div class="text-muted" style="font-size: 0.75rem;"><?= $a['sub_title']; ?></div>
                                    </td>
                                    <td>
                                        <?php if(!empty($a['album_link'])): ?>
                                            <a href="<?= $a['album_link']; ?>" target="_blank" class="badge bg-light text-dark text-decoration-none border">
                                                <i class='bx bx-link-external'></i> View Link
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted small">No Link</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-warning border-0 rounded-circle" 
                                                    data-bs-toggle="modal" data-bs-target="#editAlbumModal"
                                                    onclick="fillEditAlbumModal('<?= $a['id']; ?>', '<?= addslashes($a['title']); ?>', '<?= addslashes($a['artist_name']); ?>', '<?= addslashes($a['sub_title']); ?>', '<?= addslashes($a['badge_text']); ?>', '<?= addslashes($a['album_link']); ?>')">
                                                <i class='bx bx-edit fs-5'></i>
                                            </button>
                                            <a href="<?= base_url('admin/albums/delete/' . $a['id']); ?>" class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Hapus slide ini?')">
                                                <i class='bx bx-trash fs-5'></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">Gallery masih kosong.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAlbumModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="<?= base_url('admin/albums/save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-4">Upload New Slide</h5>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Album Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Artist Name</label>
                        <input type="text" name="artist_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Sub Title</label>
                        <input type="text" name="sub_title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Badge Text</label>
                        <input type="text" name="badge_text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Target Link (YouTube/Spotify)</label>
                        <input type="url" name="album_link" class="form-control" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Slide Image</label>
                        <input type="file" name="image_path" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-2">SAVE SLIDE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editAlbumModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <form action="<?= base_url('admin/albums/save'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" id="edit_album_id">
                <div class="modal-body p-4">
                    <h5 class="fw-bold mb-4">Edit Slide Details</h5>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Album Title</label>
                        <input type="text" name="title" id="edit_album_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Artist Name</label>
                        <input type="text" name="artist_name" id="edit_album_artist" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Sub Title</label>
                        <input type="text" name="sub_title" id="edit_album_subtitle" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Badge Text</label>
                        <input type="text" name="badge_text" id="edit_album_badge" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Target Link (YouTube/Spotify)</label>
                        <input type="url" name="album_link" id="edit_album_link" class="form-control" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-1">Change Image (Leave blank to keep current)</label>
                        <input type="file" name="image_path" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-2">UPDATE CHANGES</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function fillEditAlbumModal(id, title, artist, subtitle, badge, link) {
    document.getElementById('edit_album_id').value = id;
    document.getElementById('edit_album_title').value = title;
    document.getElementById('edit_album_artist').value = artist;
    document.getElementById('edit_album_subtitle').value = subtitle;
    document.getElementById('edit_album_badge').value = badge;
    document.getElementById('edit_album_link').value = link;
}
</script>
<?= $this->endSection(); ?>