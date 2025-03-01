<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?= site_url('tenants/view/' . $tenant->tenant_id) ?>" class="btn btn-sm btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Back to Tenant
        </a>
        <h1 class="h3 d-inline-block">Usage History: <?= htmlspecialchars($tenant->tenant_id) ?></h1>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-info-circle me-1"></i> Tenant Summary
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <div>Total Quota:</div>
                    <div class="fw-bold"><?= number_format($tenant->total_quota) ?></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div>Used Tokens:</div>
                    <div class="fw-bold"><?= number_format($tenant->used_tokens) ?></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div>Total Requests:</div>
                    <div class="fw-bold"><?= number_format($tenant->stats->total_requests ?? 0) ?></div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div>Active Users:</div>
                    <div class="fw-bold"><?= number_format($tenant->stats->unique_users ?? 0) ?></div>
                </div>

                <?php
                $percentage = ($tenant->total_quota > 0) ?
                    min(100, ($tenant->used_tokens / $tenant->total_quota) * 100) : 0;
                $class = $percentage > 90 ? 'danger' : ($percentage > 70 ? 'warning' : 'success');
                ?>
                <div class="progress mt-2" style="height: 8px;">
                    <div class="progress-bar bg-<?= $class ?>" role="progressbar"
                        style="width: <?= $percentage ?>%;"
                        aria-valuenow="<?= $percentage ?>"
                        aria-valuemin="0"
                        aria-valuemax="100">
                    </div>
                </div>
                <div class="small text-end mt-1"><?= round($percentage) ?>% Usage</div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-filter me-1"></i> Usage Filters
            </div>
            <div class="card-body">
                <form action="<?= site_url('tenants/usage/' . $tenant->tenant_id) ?>" method="get" class="row g-3">
                    <div class="col-md-4">
                        <label for="user_filter" class="form-label">User</label>
                        <select class="form-select" id="user_filter" name="user_id">
                            <option value="">All Users</option>
                            <?php foreach ($tenant->users as $user): ?>
                                <option value="<?= $user->user_id ?>" <?= $this->input->get('user_id') == $user->user_id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($user->user_id) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="provider_filter" class="form-label">Provider</label>
                        <select class="form-select" id="provider_filter" name="provider">
                            <option value="">All Providers</option>
                            <?php if (!empty($tenant->providers)):
                                foreach ($tenant->providers as $provider): ?>
                                    <option value="<?= $provider->provider ?>" <?= $this->input->get('provider') == $provider->provider ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($provider->provider) ?>
                                    </option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="date_range" class="form-label">Date Range</label>
                        <select class="form-select" id="date_range" name="date_range">
                            <option value="7" <?= $this->input->get('date_range') == '7' ? 'selected' : '' ?>>Last 7 Days</option>
                            <option value="30" <?= $this->input->get('date_range') == '30' || !$this->input->get('date_range') ? 'selected' : '' ?>>Last 30 Days</option>
                            <option value="90" <?= $this->input->get('date_range') == '90' ? 'selected' : '' ?>>Last 90 Days</option>
                            <option value="all" <?= $this->input->get('date_range') == 'all' ? 'selected' : '' ?>>All Time</option>
                        </select>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> Apply Filters
                        </button>
                        <a href="<?= site_url('tenants/usage/' . $tenant->tenant_id) ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-history me-1"></i> Usage Logs
    </div>
    <div class="card-body">
        <?php if (empty($usage_logs)): ?>
            <p class="text-muted text-center">No usage logs found for the selected criteria.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>User</th>
                            <th>Provider</th>
                            <th>Model</th>
                            <th>Tokens</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usage_logs as $log): ?>
                            <tr>
                                <td><?= date('Y-m-d H:i:s', strtotime($log->usage_date)) ?></td>
                                <td><?= htmlspecialchars($log->user_id) ?></td>
                                <td>
                                    <span class="badge badge-provider">
                                        <?= htmlspecialchars($log->provider) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-model">
                                        <?= htmlspecialchars($log->model) ?>
                                    </span>
                                </td>
                                <td><?= number_format($log->tokens) ?></td>
                                <td>
                                    <?php if ($log->has_image): ?>
                                        <span class="badge bg-info">Yes</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                <?= $pagination ?>
            </div>

            <div class="mt-3 text-muted small">
                Showing <?= count($usage_logs) ?> of <?= $this->db->where('tenant_id', $tenant->tenant_id)->count_all_results('usage_logs') ?> total logs
            </div>
        <?php endif; ?>
    </div>
</div>