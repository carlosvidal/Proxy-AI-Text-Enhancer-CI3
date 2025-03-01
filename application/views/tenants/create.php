<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?= site_url('tenants') ?>" class="btn btn-sm btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Back to Tenants
        </a>
        <h1 class="h3 d-inline-block">Create New Tenant</h1>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-building me-1"></i> Tenant Information
    </div>
    <div class="card-body">
        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?= validation_errors() ?>
            </div>
        <?php endif; ?>

        <?= form_open('tenants/create', ['class' => 'needs-validation']) ?>
        <div class="mb-3">
            <label for="tenant_id" class="form-label">Tenant ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tenant_id" name="tenant_id"
                value="<?= set_value('tenant_id') ?>" required
                placeholder="Enter unique tenant identifier">
            <div class="form-text">
                Use a unique identifier for your tenant (e.g., company-name, organization-id)
            </div>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Initial User ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="user_id" name="user_id"
                value="<?= set_value('user_id') ?>" required
                placeholder="Enter user identifier">
            <div class="form-text">
                Each tenant needs at least one user. You can add more users later.
            </div>
        </div>

        <div class="mb-3">
            <label for="total_quota" class="form-label">Token Quota <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="total_quota" name="total_quota"
                value="<?= set_value('total_quota', 100000) ?>" required min="1">
            <div class="form-text">
                The total token quota allocated to this user (e.g., 100,000)
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
                <i class="fas fa-save me-1"></i> Create Tenant
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>