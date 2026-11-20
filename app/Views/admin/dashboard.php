<?= $this->extend('layout/admin_template'); ?>

<?= $this->section('admin_content'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* --- Dashboard Core Styles --- */
    .card-stats {
        background: #fff;
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .card-stats:hover { 
        transform: translateY(-7px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    }
    
    .stat-icon {
        width: 55px; height: 55px;
        border-radius: 15px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 20px;
    }

    /* --- Custom Colors --- */
    .bg-soft-gold { background: #fffdf0; color: #FFD700; }
    .bg-soft-blue { background: #f0f7ff; color: #007bff; }
    .bg-soft-red { background: #fff5f5; color: #ff4757; }
    .bg-soft-green { background: #f0fff4; color: #2ecc71; }
    .bg-soft-purple { background: #f5f3ff; color: #8e44ad; }
    .bg-soft-dark { background: #f8f9fa; color: #2d3436; }

    .recent-activity {
        background: #fff;
        border-radius: 24px;
        padding: 25px;
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
    }

    .quick-link {
        text-decoration: none;
        color: #2d3436;
        padding: 12px 15px;
        border-radius: 14px;
        display: flex; align-items: center; gap: 12px;
        transition: all 0.2s;
        border: 1px solid #f1f2f6;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .quick-link:hover { 
        background: #1a1a1a; 
        color: #FFD700; 
        transform: scale(1.02);
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .status-dot {
        height: 8px; width: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
</style>

<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <h2 class="fw-bold m-0" style="letter-spacing: -1px;">Control Center</h2>
        <p class="text-muted">Welcome back, Administrator. Here's what's happening.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <span class="badge bg-white text-dark shadow-sm p-2 px-3 rounded-pill border">
            <i class='bx bx-refresh me-1'></i> Auto-sync: Enabled
        </span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card-stats">
            <div class="stat-icon bg-soft-gold"><i class='bx bxs-microphone-alt'></i></div>
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <small class="text-muted fw-bold d-block mb-1">ARTISTS</small>
                    <h3 class="fw-bold m-0"><?= $totalArtists; ?></h3>
                </div>
                <span class="text-success small fw-bold"><i class='bx bx-up-arrow-alt'></i> Active</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-stats">
            <div class="stat-icon bg-soft-blue"><i class='bx bxs-album'></i></div>
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <small class="text-muted fw-bold d-block mb-1">DISCOGRAPHY</small>
                    <h3 class="fw-bold m-0"><?= $totalAlbums; ?></h3>
                </div>
                <span class="text-primary small fw-bold">Katalog</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-stats">
            <div class="stat-icon bg-soft-purple"><i class='bx bxs-megaphone'></i></div>
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <small class="text-muted fw-bold d-block mb-1">AUDITIONS</small>
                    <h3 class="fw-bold m-0"><?= $totalAuditions; ?></h3>
                </div>
                <span class="text-danger small fw-bold">Live</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card-stats">
            <div class="stat-icon bg-soft-green"><i class='bx bxs-user-voice'></i></div>
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <small class="text-muted fw-bold d-block mb-1">APPLICANTS</small>
                    <h3 class="fw-bold m-0"><?= $totalApplications; ?></h3>
                </div>
                <span class="badge bg-danger rounded-pill px-2">New</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="recent-activity">
            <h5 class="fw-bold mb-4">Content Distribution</h5>
            <div class="chart-container">
                <canvas id="mainChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="recent-activity">
            <h5 class="fw-bold mb-4">Master Controls</h5>
            <div class="d-grid gap-3">
                <a href="<?= base_url('admin/artists'); ?>" class="quick-link">
                    <i class='bx bx-user-plus fs-4'></i> Register New Artist
                </a>
                <a href="<?= base_url('admin/auditions'); ?>" class="quick-link">
                    <i class='bx bx-broadcast fs-4'></i> Launch New Audition
                </a>
                <a href="<?= base_url('admin/gallery'); ?>" class="quick-link">
                    <i class='bx bx-images fs-4'></i> Manage Visual Assets
                </a>
                <a href="<?= base_url('admin/opportunities'); ?>" class="quick-link">
                    <i class='bx bx-briefcase fs-4'></i> Update Careers & Partners
                </a>
                <a href="<?= base_url('admin/about'); ?>" class="quick-link">
                    <i class='bx bx-cog fs-4'></i> Agency Core Settings
                </a>
            </div>
            
            <div class="mt-4 p-4 rounded-4 bg-dark text-white">
                <div class="d-flex align-items-center mb-2">
                    <span class="status-dot bg-success"></span>
                    <small class="fw-bold text-warning">SERVER STATUS: OPTIMAL</small>
                </div>
                <p class="m-0 opacity-50" style="font-size: 0.7rem;">Database is running smoothly. Last backup: Today, 04:00 AM.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="recent-activity">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">Recent Talent Entry</h5>
                <a href="<?= base_url('admin/applications'); ?>" class="btn btn-dark btn-sm rounded-pill px-3">Review All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="text-muted" style="font-size: 0.75rem;">
                            <th>TALENT NAME</th>
                            <th>CATEGORY</th>
                            <th>AUDITION SESSION</th>
                            <th>APPLIED DATE</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.85rem;">
                        <?php if(!empty($recentApplications)): foreach($recentApplications as $app): ?>
                        <tr>
                            <td>
                                <div class="fw-bold text-dark"><?= $app['name']; ?></div>
                                <small class="text-muted"><?= $app['email'] ?? 'No email'; ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= $app['category'] ?? 'Talent'; ?></span></td>
                            <td class="text-muted"><?= $app['audition_title']; ?></td>
                            <td class="fw-bold"><?= date('d/m/Y', strtotime($app['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-5">No pending applications found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="recent-activity bg-light-blue border-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">Latest Inquiries</h5>
                <span class="badge bg-primary rounded-pill"><?= $totalInquiries; ?></span>
            </div>
            
            <div class="inquiry-list">
                <?php if($totalInquiries > 0): ?>
                    <div class="p-3 bg-white rounded-4 border mb-3 shadow-sm">
                        <small class="text-primary fw-bold d-block mb-1">New Message Received</small>
                        <p class="small text-muted mb-0">You have <?= $totalInquiries; ?> unread business inquiries in your inbox.</p>
                        <a href="<?= base_url('admin/inquiries'); ?>" class="btn btn-link btn-sm p-0 mt-2 fw-bold text-decoration-none text-dark">Check Messages →</a>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class='bx bx- ghost fs-1 text-muted opacity-25'></i>
                        <p class="text-muted small mt-2">Inbox is clean.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('mainChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Talent Applications',
                data: [12, 19, 3, 5], // Data dummy, bisa dikoneksikan ke DB nanti
                borderColor: '#FFD700',
                backgroundColor: 'rgba(255, 215, 0, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }, {
                label: 'New Releases',
                data: [2, 3, 15, 10],
                borderColor: '#1a1a1a',
                borderWidth: 2,
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
</script>

<?= $this->endSection(); ?>