<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?= site_url('tenants') ?>" class="btn btn-sm btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Back to Tenants
        </a>
        <h1 class="h3 d-inline-block"><?= htmlspecialchars($tenant->tenant_id) ?></h1>
    </div>
    <div>
        <a href="<?= site_url('tenants/usage/' . $tenant->tenant_id) ?>" class="btn btn-outline-info me-2">
            <i class="fas fa-chart-line me-1"></i> View Usage History
        </a>
        <a href="<?= site_url('tenants/delete/' . $tenant->tenant_id) ?>" class="btn btn-outline-danger">
            <i class="fas fa-trash me-1"></i> Delete Tenant
        </a>
    </div>
</div>

<div class="row">
    <!-- Tenant Overview Card -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="fas fa-info-circle me-1"></i> Tenant Overview
            </div>
            <div class="card-body">
                <div class="tenant-stats">
                    <div class="mb-3">
                        <div class="text-muted small">Total Quota</div>
                        <div class="h3"><?= number_format($tenant->total_quota) ?></div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">Used Tokens</div>
                        <div class="h3"><?= number_format($tenant->used_tokens) ?></div>
                    </div>

                    <div class="mb-4">
                        <div class="text-muted small">Usage (Last 30 Days)</div>
                        <?php
                        $percentage = ($tenant->total_quota > 0) ?
                            min(100, ($tenant->used_tokens / $tenant->total_quota) * 100) : 0;
                        $class = $percentage > 90 ? 'danger' : ($percentage > 70 ? 'warning' : 'success');
                        ?>
                        <div class="progress mt-1" style="height: 10px;">
                            <div class="progress-bar bg-<?= $class ?>" role="progressbar"
                                style="width: <?= $percentage ?>%;"
                                aria-valuenow="<?= $percentage ?>"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <div class="small text-end mt-1"><?= round($percentage) ?>%</div>
                    </div>

                    <div class="mt-4">
                        <div class="text-muted small mb-2">Key Statistics</div>
                        <div class="d-flex justify-content-between mb-2">
                            <div>Total Users:</div>
                            <div class="fw-bold"><?= count($tenant->users) ?></div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <div>Total Requests:</div>
                            <div class="fw-bold"><?= number_format(isset($tenant->stats->total_requests) ? $tenant->stats->total_requests : 0) ?></div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <div>Image Requests:</div>
                            <div class="fw-bold"><?= number_format(isset($tenant->stats->image_requests) ? $tenant->stats->image_requests : 0) ?></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>Active Users:</div>
                            <div class="fw-bold"><?= number_format(isset($tenant->stats->unique_users) ? $tenant->stats->unique_users : 0) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Usage Chart Card -->
    <div class="col-md-8 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i> Usage Over Time (Last 30 Days)
            </div>
            <div class="card-body">
                <?php if (empty($usage_by_date)): ?>
                    <p class="text-muted text-center">No usage data available.</p>
                <?php else: ?>
                    <canvas id="usageChart" height="300"></canvas>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Provider Usage -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="fas fa-server me-1"></i> Provider Usage
            </div>
            <div class="card-body">
                <?php if (empty($tenant->providers)): ?>
                    <p class="text-muted text-center">No provider data available.</p>
                <?php else: ?>
                    <canvas id="providerChart" height="220"></canvas>
                    <div class="mt-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Provider</th>
                                    <th class="text-end">Requests</th>
                                    <th class="text-end">Tokens</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tenant->providers as $provider): ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-provider">
                                                <?= htmlspecialchars($provider->provider) ?>
                                            </span>
                                        </td>
                                        <td class="text-end"><?= number_format($provider->count) ?></td>
                                        <td class="text-end"><?= number_format(isset($provider->tokens) ? $provider->tokens : 0) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Users List -->
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-users me-1"></i> Users
                </div>
                <a href="<?= site_url('tenants/add_user/' . $tenant->tenant_id) ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-user-plus me-1"></i> Add User
                </a>
            </div>
            <div class="card-body">
                <?php if (empty($tenant->users)): ?>
                    <p class="text-muted text-center">No users found.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Quota</th>
                                    <th>Used</th>
                                    <th>Remaining</th>
                                    <th>Reset Period</th>
                                    <th>Usage</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tenant->users as $user): ?>
                                    <tr>
                                        <td class="fw-bold"><?= htmlspecialchars($user->user_id) ?></td>
                                        <td><?= number_format($user->total_quota) ?></td>
                                        <td><?= number_format($user->used_tokens) ?></td>
                                        <td><?= number_format($user->remaining_quota) ?></td>
                                        <td><?= ucfirst($user->reset_period) ?></td>
                                        <td>
                                            <?php
                                            $percentage = $user->usage_percentage;
                                            $class = $percentage > 90 ? 'danger' : ($percentage > 70 ? 'warning' : 'success');
                                            ?>
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-<?= $class ?>" role="progressbar"
                                                    style="width: <?= $percentage ?>%;"
                                                    aria-valuenow="<?= $percentage ?>"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <small class="text-muted"><?= round($percentage) ?>%</small>
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="<?= site_url('tenants/edit_user/' . $tenant->tenant_id . '/' . $user->user_id) ?>"
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= site_url('tenants/delete_user/' . $tenant->tenant_id . '/' . $user->user_id) ?>"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete User">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Inicialización de gráficos -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (!empty($usage_by_date)): ?>
            // Usage Chart
            const usageCtx = document.getElementById('usageChart').getContext('2d');

            const usageData = <?= json_encode($usage_by_date) ?>;
            const labels = usageData.map(item => item.date);
            const requestsData = usageData.map(item => parseInt(item.requests));
            const tokensData = usageData.map(item => parseInt(item.tokens));

            new Chart(usageCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Requests',
                            data: requestsData,
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            yAxisID: 'y'
                        },
                        {
                            label: 'Tokens',
                            data: tokensData,
                            borderColor: '#8b5cf6',
                            backgroundColor: 'rgba(139, 92, 246, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Requests'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Tokens'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });
        <?php endif; ?>

        <?php if (!empty($tenant->providers)): ?>
            // Provider Chart
            const providerCtx = document.getElementById('providerChart').getContext('2d');

            const providerData = <?= json_encode($tenant->providers) ?>;
            const providerLabels = providerData.map(item => item.provider);
            const providerCounts = providerData.map(item => parseInt(item.count));

            const providerColors = [
                '#3b82f6', // blue
                '#10b981', // green
                '#8b5cf6', // purple
                '#f59e0b', // amber
                '#ef4444', // red
                '#06b6d4', // cyan
                '#ec4899' // pink
            ];

            new Chart(providerCtx, {
                type: 'doughnut',
                data: {
                    labels: providerLabels,
                    datasets: [{
                        data: providerCounts,
                        backgroundColor: providerColors.slice(0, providerLabels.length),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        <?php endif; ?>
    });
</script>