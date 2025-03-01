<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?= site_url('tenants/view/' . $tenant->tenant_id) ?>" class="btn btn-sm btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Back to Tenant
        </a>
        <h1 class="h3 d-inline-block">Add User to Tenant: <?= htmlspecialchars($tenant->tenant_id) ?></h1>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-user-plus me-1"></i> User Information
    </div>
    <div class="card-body">
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?= validation_errors() ?>
            </div>
        <?php endif; ?>

        <?= form_open('tenants/add_user/' . $tenant->tenant_id, ['class' => 'needs-validation']) ?>
        <div class="mb-3">
            <label for="user_id" class="form-label">User ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="user_id" name="user_id"
                value="<?= set_value('user_id') ?>" required
                placeholder="Enter user identifier">
            <div class="form-text">
                A unique identifier for this user within the tenant
            </div>
        </div>

        <div class="mb-3">
            <label for="total_quota" class="form-label">Token Quota <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="total_quota" name="total_quota"
                value="<?= set_value('total_quota', 50000) ?>" required min="1">
            <div class="form-text">
                The total token quota allocated to this user (e.g., 50,000)
            </div>
        </div>

        <div class="mb-4">
            <label for="reset_period" class="form-label">Reset Period</label>
            <select class="form-select" id="reset_period" name="reset_period">
                <?php foreach ($reset_periods as $value => $label): ?>
                    <option value="<?= $value ?>" <?= set_select('reset_period', $value, $value === 'monthly') ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="form-text">
                How often the quota should reset
            </div>
        </div>

        <div class="d-grid d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Add User
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>