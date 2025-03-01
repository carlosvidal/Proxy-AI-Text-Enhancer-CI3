<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="<?= site_url('tenants/view/' . $tenant_id) ?>" class="btn btn-sm btn-outline-secondary me-2">
            <i class="fas fa-arrow-left"></i> Back to Tenant
        </a>
        <h1 class="h3 d-inline-block">Delete User</h1>
    </div>
</div>

<div class="card border-danger">
    <div class="card-header bg-danger text-white">
        <i class="fas fa-exclamation-triangle me-1"></i> Confirmation Required
    </div>
    <div class="card-body">
        <h5 class="card-title">Are you sure you want to delete this user?</h5>
        <p class="card-text">
            You are about to delete user <strong><?= htmlspecialchars($user_id) ?></strong>
            from tenant <strong><?= htmlspecialchars($tenant_id) ?></strong>.
        </p>
        <p class="card-text">
            This action will permanently remove the user and their quota settings. The user's usage logs will remain in the system.
            This action cannot be undone.
        </p>

        <?= form_open('tenants/delete_user/' . $tenant_id . '/' . $user_id, ['class' => 'mt-4']) ?>
        <input type="hidden" name="confirm" value="yes">
        <div class="d-flex justify-content-end">
            <a href="<?= site_url('tenants/view/' . $tenant_id) ?>" class="btn btn-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash me-1"></i> Delete User
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>