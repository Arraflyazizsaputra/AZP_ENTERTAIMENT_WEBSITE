<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admin_content'); ?>

<style>
    #view_message {
        white-space: pre-wrap; 
        word-wrap: break-word;
        line-height: 1.6;
        background: #f8f9fa;
        border: 1px solid #eee;
        min-height: 100px;
        color: #333;
    }
    .table-hover tbody tr:hover {
        background-color: #fdfdfd;
        cursor: pointer;
    }
</style>

<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="fw-bold m-0 text-uppercase" style="letter-spacing: -1px;">Contact Messages</h2>
        <p class="text-muted small">Kelola pesan dan pertanyaan masuk dari pengunjung website.</p>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-3"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 border-0 text-muted small fw-bold">SENDER</th>
                            <th class="py-3 border-0 text-muted small fw-bold">SUBJECT & PREVIEW</th>
                            <th class="py-3 border-0 text-muted small fw-bold">DATE</th>
                            <th class="pe-4 py-3 border-0 text-muted small fw-bold text-end">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($inquiries)): foreach($inquiries as $msg): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?= esc($msg['name']); ?></div>
                                <div class="text-muted small"><?= esc($msg['email']); ?></div>
                            </td>
                            <td>
                                <div class="fw-bold mb-0 text-uppercase small text-primary" style="letter-spacing: 1px;"><?= esc($msg['subject']); ?></div>
                                <div class="text-muted small text-truncate" style="max-width: 250px;"><?= esc($msg['message']); ?></div>
                            </td>
                            <td class="text-muted small">
                                <?= date('d M Y', strtotime($msg['created_at'])); ?>
                                <div style="font-size: 0.65rem;"><?= date('H:i', strtotime($msg['created_at'])); ?> WIB</div>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-sm btn-dark rounded-circle" 
                                            onclick="viewMessage('<?= addslashes(esc($msg['name'])); ?>', '<?= addslashes(esc($msg['email'])); ?>', '<?= addslashes(esc($msg['subject'])); ?>', '<?= addslashes(esc($msg['message'])); ?>')">
                                        <i class='bx bx-show fs-5'></i>
                                    </button>
                                    <a href="<?= base_url('admin/inquiries/delete/' . $msg['id']); ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-circle" 
                                       onclick="return confirm('Hapus pesan ini secara permanen?')">
                                        <i class='bx bx-trash fs-5'></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada pesan yang masuk.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="msgModal" tabindex="-1" aria-labelledby="msgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold" id="msgModalLabel"><i class='bx bx-envelope me-2'></i>MESSAGE DETAILS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <label class="small fw-bold text-muted text-uppercase" style="letter-spacing: 2px;">Sender Info</label>
                    <p class="mb-0 fw-bold fs-5" id="view_name" style="color: #000;"></p>
                    <a href="#" id="view_email_link" class="text-decoration-none small">
                        <i class='bx bx-mail-send'></i> <span id="view_email"></span>
                    </a>
                </div>
                <div class="mb-4">
                    <label class="small fw-bold text-muted text-uppercase" style="letter-spacing: 2px;">Subject</label>
                    <p class="fw-bold text-dark" id="view_subject"></p>
                </div>
                <div class="mb-0">
                    <label class="small fw-bold text-muted text-uppercase" style="letter-spacing: 2px;">Message Content</label>
                    <div class="p-4 rounded-4 small" id="view_message"></div>
                </div>
            </div>
            <div class="modal-footer border-0 p-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">CLOSE</button>
                <a href="#" id="reply_btn" class="btn btn-dark rounded-pill px-4 fw-bold text-warning">REPLY VIA EMAIL</a>
            </div>
        </div>
    </div>
</div>

<script>
    function viewMessage(name, email, subject, message) {
        // 1. Isi data ke elemen modal
        document.getElementById('view_name').innerText = name;
        document.getElementById('view_email').innerText = email;
        document.getElementById('view_subject').innerText = subject;
        document.getElementById('view_message').innerText = message;
        
        // 2. Setup link email
        document.getElementById('view_email_link').href = "mailto:" + email;
        document.getElementById('reply_btn').href = "mailto:" + email + "?subject=Re: " + encodeURIComponent(subject);
        
        // 3. Panggil modal secara manual menggunakan Vanilla JS (Lebih Aman)
        var myModal = new bootstrap.Modal(document.getElementById('msgModal'), {
            keyboard: false
        });
        myModal.show();
    }
</script>

<?= $this->endSection(); ?>