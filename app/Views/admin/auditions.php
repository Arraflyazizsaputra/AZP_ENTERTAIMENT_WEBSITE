<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-uppercase" style="letter-spacing: 2px;">Audition Sessions</h2>
            <p class="text-muted small">Kelola informasi lowongan bakat baru AZP Studio.</p>
        </div>
     <button class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm" onclick="openAuditionModal()">
    <i class='bx bx-plus me-1'></i> NEW AUDITION
</button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="p-3 bg-white border rounded-4 shadow-sm">
                <small class="text-muted fw-bold d-block">TOTAL SESI</small>
                <span class="h4 fw-bold"><?= count($auditions); ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-white border rounded-4 shadow-sm">
                <small class="text-success fw-bold d-block">STATUS: OPEN</small>
                <span class="h4 fw-bold">
                    <?php 
                        $openCount = array_filter($auditions, fn($a) => $a['status'] == 'Open');
                        echo count($openCount);
                    ?>
                </span>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                            <th class="ps-4 py-3 border-0 text-muted fw-bold">Kategori</th>
                            <th class="py-3 border-0 text-muted fw-bold">Informasi Detail</th>
                            <th class="py-3 border-0 text-muted fw-bold">Batas Akhir</th>
                            <th class="py-3 border-0 text-muted fw-bold text-center">Status</th>
                            <th class="pe-4 py-3 border-0 text-muted fw-bold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($auditions)) : foreach ($auditions as $row) : ?>
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2" style="font-size: 0.65rem; font-weight: 800;">
                                        <?= esc($row['category']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark mb-1"><?= esc($row['title']); ?></div>
                                    <div class="text-muted small text-truncate" style="max-width: 300px;">
                                        <?= esc($row['requirements']); ?>
                                    </div>
                                </td>
                                <td class="text-muted small">
                                    <div class="d-flex align-items-center">
                                        <i class='bx bx-calendar-event me-2 fs-5'></i>
                                        <?= date('d M Y', strtotime($row['deadline'])); ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php if($row['status'] == 'Open'): ?>
                                        <span class="badge rounded-pill px-3 bg-success-subtle text-success border border-success">OPEN</span>
                                    <?php else: ?>
                                        <span class="badge rounded-pill px-3 bg-danger-subtle text-danger border border-danger">CLOSED</span>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-white border me-2 rounded-3 shadow-sm" 
                                                title="Edit" 
                                                onclick="editAudition(<?= htmlspecialchars(json_encode($row)); ?>)">
                                            <i class='bx bx-edit-alt'></i>
                                        </button>
                                        <button class="btn btn-sm btn-white border text-danger rounded-3 shadow-sm" 
                                                title="Hapus"
                                                onclick="confirmDelete('<?= base_url('admin/auditions/delete/' . $row['id']); ?>')">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; else : ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class='bx bx-info-circle fs-1 text-muted opacity-25 mb-3'></i>
                                    <p class="text-muted">Belum ada sesi audisi yang dibuat.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="auditionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="<?= base_url('admin/auditions/save'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold" id="modalTitle">TAMBAH SESI AUDISI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="audition_id">

                    <div class="mb-3">
                        <label class="small fw-bold mb-2">KATEGORI</label>
                        <input type="text" name="category" id="category" class="form-control rounded-3" placeholder="Misal: VOCAL, DANCE, RAP" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">JUDUL AUDISI</label>
                        <input type="text" name="title" id="title" class="form-control rounded-3" placeholder="Contoh: Global Audition 2026" required>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">SYARAT & INFORMASI</label>
                        <textarea name="requirements" id="requirements" class="form-control rounded-3" rows="5" placeholder="Tuliskan detail persyaratan di sini..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="small fw-bold mb-2">TENGGAT WAKTU</label>
                            <input type="date" name="deadline" id="deadline" class="form-control rounded-3" required>
                        </div>
                        <div class="col-6">
                            <label class="small fw-bold mb-2">STATUS</label>
                            <select name="status" id="status" class="form-select rounded-3">
                                <option value="Open">Open (Terbuka)</option>
                                <option value="Closed">Closed (Tutup)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn btn-dark w-100 fw-bold py-2 rounded-pill shadow-sm">
                        SIMPAN DATA AUDISI
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Inisialisasi variabel di scope global
    let auditionModalObj;

    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Modal Bootstrap
        const modalElement = document.getElementById('auditionModal');
        if (modalElement) {
            auditionModalObj = new bootstrap.Modal(modalElement);
        }

        // Daftarkan fungsi ke window agar bisa dipanggil via onclick di HTML
        window.openAuditionModal = function() {
            console.log("Membuka modal tambah..."); // Debugging
            
            // Reset Form
            document.getElementById('modalTitle').innerText = "ADD NEW AUDITION";
            document.getElementById('audition_id').value = ""; 
            document.getElementById('category').value = "";
            document.getElementById('title').value = "";
            document.getElementById('requirements').value = "";
            document.getElementById('deadline').value = "";
            document.getElementById('status').value = "Open";
            
            if(auditionModalObj) auditionModalObj.show();
        };

        window.editAudition = function(data) {
            console.log("Membuka modal edit ID:", data.id); // Debugging
            
            document.getElementById('modalTitle').innerText = "EDIT AUDITION SESSION";
            document.getElementById('audition_id').value = data.id;
            document.getElementById('category').value = data.category;
            document.getElementById('title').value = data.title;
            document.getElementById('requirements').value = data.requirements;
            document.getElementById('deadline').value = data.deadline;
            document.getElementById('status').value = data.status;
            
            if(auditionModalObj) auditionModalObj.show();
        };
    });

    // Fungsi Hapus Tetap Sama
    function confirmDelete(url) {
        Swal.fire({
            title: 'Hapus Sesi Ini, Bos?',
            text: "Data yang dihapus nggak bisa balik lagi lho, yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#121212',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, Hapus Aja!',
            cancelButtonText: 'Gak Jadi',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }
</script>

<?= $this->endSection(); ?>