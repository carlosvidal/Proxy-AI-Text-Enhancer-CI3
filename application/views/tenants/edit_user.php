<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?= site_url('tenants/view/' . $tenant->tenant_id) ?>" class="btn btn-sm btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Back to Tenant
        </a>
        <h1 class="h3 d-inline-block">Edit User: <?= htmlspecialchars($user->user_id) ?></h1>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-user-edit me-1"></i> Edit User Quota
    </div>
    <div class="card-body">
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?= validation_errors() ?>
            </div>
        <?php endif; ?>

        <?= form_open('tenants/edit_user/' . $tenant->tenant_id . '/' . $user->user_id, ['class' => 'needs-validation']) ?>
        <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <input type="text" class="form-control" id="user_id" value="<?= htmlspecialchars($user->user_id) ?>" readonly disabled>
            <div class="form-text">
                User ID cannot be changed
            </div>
        </div>

        <div class="mb-3">
            <label for="total_quota" class="form-label">Token Quota <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="total_quota" name="total_quota"
                value="<?= set_value('total_quota', $user->total_quota) ?>" required min="1">
            <div class="form-text">
                The total token quota allocated to this user
            </div>
        </div>

        <div class="mb-4">
            <label for="reset_period" class="form-label">Reset Period</label>
            <select class="form-select" id="reset_period" name="reset_period">
                <?php foreach ($reset_periods as $value => $label): ?>
                    <option value="<?= $value ?>" <?= set_select('reset_period', $value, $value === $user->reset_period) ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="form-text">
                How often the quota should reset
            </div>
        </div>

        <div class="mb-3">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title">Current Usage</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <div>Used Tokens:</div>
                        <div class="fw-bold"><?= number_format($user->used_tokens) ?></div>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <div>Remaining Quota:</div>
                        <div class="fw-bold"><?= number_format($user->remaining_quota) ?></div>
                    </div>

                    <?php
                    $percentage = $user->usage_percentage;
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
                    <div class="small text-end mt-1"><?= round($percentage) ?>%</div>
                </div>
            </div>
        </div>

        <div class="d-grid d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Update User
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>