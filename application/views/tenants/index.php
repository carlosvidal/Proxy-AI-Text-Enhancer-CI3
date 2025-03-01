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
    <h1 class="h3">Tenant Management</h1>
    <a href="<?= site_url('tenants/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Create New Tenant
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-building me-1"></i> Tenants List
    </div>
    <div class="card-body">
        <?php if (empty($tenants)): ?>
            <p class="text-muted text-center">No tenants found.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tenant ID</th>
                            <th>Users</th>
                            <th>Total Quota</th>
                            <th>Usage</th>
                            <th>Last Usage</th>
                            <th>Primary Provider</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tenants as $tenant): ?>
                            <tr>
                                <td>
                                    <a href="<?= site_url('tenants/view/' . $tenant->tenant_id) ?>" class="fw-bold text-decoration-none">
                                        <?= htmlspecialchars($tenant->tenant_id) ?>
                                    </a>
                                </td>
                                <td><?= $tenant->user_count ?></td>
                                <td><?= number_format($tenant->total_quota) ?></td>
                                <td>
                                    <?php
                                    $percentage = $tenant->usage_percentage;
                                    $class = $percentage > 90 ? 'danger' : ($percentage > 70 ? 'warning' : 'success');
                                    ?>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-<?= $class ?>" role="progressbar"
                                            style="width: <?= $percentage ?>%;"
                                            aria-valuenow="<?= $percentage ?>"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        <?= number_format($tenant->used_tokens) ?> / <?= number_format($tenant->total_quota) ?>
                                        (<?= round($percentage) ?>%)
                                    </small>
                                </td>
                                <td>
                                    <?php if ($tenant->last_usage): ?>
                                        <span title="<?= $tenant->last_usage ?>">
                                            <?= date('Y-m-d', strtotime($tenant->last_usage)) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">Never</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($tenant->providers)): ?>
                                        <span class="badge badge-provider">
                                            <?= htmlspecialchars($tenant->providers[0]->provider) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">None</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="<?= site_url('tenants/view/' . $tenant->tenant_id) ?>"
                                            class="btn btn-sm btn-outline-primary"
                                            title="View Tenant">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= site_url('tenants/usage/' . $tenant->tenant_id) ?>"
                                            class="btn btn-sm btn-outline-info"
                                            title="Usage History">
                                            <i class="fas fa-chart-line"></i>
                                        </a>
                                        <a href="<?= site_url('tenants/delete/' . $tenant->tenant_id) ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete Tenant">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?= $pagination ?>
            </div>
        <?php endif; ?>
    </div>
</div>