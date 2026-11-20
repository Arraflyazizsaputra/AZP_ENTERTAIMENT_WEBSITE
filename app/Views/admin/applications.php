<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-uppercase" style="letter-spacing: 2px;">Talent Applicants</h2>
            <p class="text-muted small">Review pendaftar yang ingin bergabung dengan AZP Studio.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                            <th class="ps-4 py-3 border-0 text-muted fw-bold">Nama Pelamar</th>
                            <th class="py-3 border-0 text-muted fw-bold">Audisi & Kategori</th>
                            <th class="py-3 border-0 text-muted fw-bold">Kontak</th>
                            <th class="py-3 border-0 text-muted fw-bold text-center">Status</th>
                            <th class="pe-4 py-3 border-0 text-muted fw-bold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($applications)): foreach ($applications as $app): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark"><?= esc($app['name']); ?></div>
                                        <div class="text-muted small"><?= date('d M Y, H:i', strtotime($app['created_at'])); ?></div>
                                    </td>
                                    <td>
                                        <div class="badge bg-warning text-dark mb-1" style="font-size: 0.6rem;"><?= esc($app['category']); ?></div>
                                        <div class="small fw-bold"><?= esc($app['audition_title']); ?></div>
                                    </td>
                                    <td>
                                        <div class="small text-dark"><i class='bx bx-envelope me-1'></i> <?= esc($app['email']); ?></div>
                                        <div class="small text-muted"><i class='bx bx-phone me-1'></i> <?= esc($app['phone']); ?></div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill px-3 bg-secondary-subtle text-secondary border border-secondary" style="font-size: 0.7rem;">PENDING</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-dark rounded-3 px-3 me-2 shadow-sm btn-view-detail"
                                                data-applicant='<?= htmlspecialchars(json_encode($app), ENT_QUOTES, 'UTF-8'); ?>'>
                                                <i class='bx bx-show me-1'></i> Detail
                                            </button>

                                            <button class="btn btn-sm btn-light border text-danger rounded-3"
                                                onclick="confirmDelete('<?= base_url('admin/applications/delete/' . $app['id']); ?>')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class='bx bx-user-x fs-1 text-muted opacity-25'></i>
                                    <p class="text-muted mt-2">Belum ada pelamar yang mendaftar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold">APPLICANT DOSSIER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-5 border-end">
                        <div class="mb-4">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Full Name</label>
                            <h4 class="fw-bold" id="det-name"></h4>
                        </div>
                        <div class="mb-4">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Audition Applied</label>
                            <div class="p-2 bg-light rounded-3">
                                <span class="badge bg-warning text-dark mb-1" id="det-cat"></span>
                                <div class="fw-bold small" id="det-title"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-1">Portfolio Link</label>
                            <a href="#" id="det-portfolio" target="_blank" class="btn btn-outline-dark btn-sm w-100 rounded-pill">
                                <i class='bx bx-link-external me-1'></i> Open Portfolio
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="mb-4">
                            <label class="text-muted small fw-bold text-uppercase d-block mb-2">Message / Motivation</label>
                            <div class="p-3 bg-light rounded-4 text-secondary" id="det-message"
                                style="min-height: 150px; font-size: 0.9rem; line-height: 1.6; font-style: italic; word-wrap: break-word; overflow-wrap: break-word; white-space: pre-wrap; max-height: 300px; overflow-y: auto;">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="#" id="det-email-btn" class="btn btn-dark fw-bold py-2 rounded-pill shadow-sm">
                            <i class='bx bx-reply me-1'></i> BALAS VIA EMAIL
                        </a>
                        <a href="#" id="det-wa-btn" target="_blank" class="btn btn-success fw-bold py-2 rounded-pill shadow-sm">
                            <i class='bx bxl-whatsapp me-1'></i> HUBUNGI VIA WHATSAPP
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    /* Tambahkan ini untuk kontrol teks deskripsi */
    #det-message {
        word-wrap: break-word;
        /* Memotong kata yang terlalu panjang */
        overflow-wrap: break-word;
        /* Standar modern untuk memotong kata */
        white-space: pre-wrap;
        /* Menjaga format baris baru/enter dari user */
        max-height: 300px;
        /* Membatasi tinggi agar modal tidak terlalu panjang */
        overflow-y: auto;
        /* Munculkan scrollbar jika teks sangat panjang */
        border: 1px solid #f0f0f0;
        /* Border halus agar kotak terlihat jelas */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Inisialisasi Modal
        const modalElement = document.getElementById('detailModal');
        const detailModal = new bootstrap.Modal(modalElement);

        // 2. Event Listener untuk tombol Detail
        const viewButtons = document.querySelectorAll('.btn-view-detail');

        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-applicant
                const data = JSON.parse(this.getAttribute('data-applicant'));

                // Isi data ke dalam modal
                document.getElementById('det-name').innerText = data.name;
                document.getElementById('det-cat').innerText = data.category;
                document.getElementById('det-title').innerText = data.audition_title;
                document.getElementById('det-message').innerText = data.message || "Tidak ada pesan tambahan.";
                document.getElementById('det-portfolio').href = data.portfolio_link;

                // Atur Button Email (mailto)
                const subject = encodeURIComponent(`AZP STUDIO - Respon Audisi ${data.audition_title}`);
                const body = encodeURIComponent(`Halo ${data.name},\n\nTerima kasih telah melamar untuk posisi ${data.audition_title} di AZP Studio.\n\n`);
                document.getElementById('det-email-btn').href = `mailto:${data.email}?subject=${subject}&body=${body}`;

                // Atur Button WhatsApp
                let phone = data.phone.replace(/[^0-9]/g, '');
                if (phone.startsWith('0')) phone = '62' + phone.slice(1);
                document.getElementById('det-wa-btn').href = `https://wa.me/${phone}?text=${encodeURIComponent('Halo ' + data.name + ', kami dari AZP Studio Sudah Menerima Lamaran Audisi Anda, dan diminta untuk Mengonfirmasi Ulang saya siap mengikuti Audisi ke tempat kami')}`;

                // Tampilkan Modal
                detailModal.show();
            });
        });
    });

    // Fungsi Hapus tetap sama
    function confirmDelete(url) {
        Swal.fire({
            title: 'Hapus data pelamar?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#121212',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

<?= $this->endSection(); ?>