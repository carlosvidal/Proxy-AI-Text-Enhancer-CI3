<!DOCTYPE html>
<html lang="en">
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'LLM Proxy Usage Dashboard'; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #475569;
            --accent-color: #8b5cf6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --background-color: #f9fafb;
            --card-bg-color: #ffffff;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 56px;
        }

        .navbar {
            background-color: var(--card-bg-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            background-color: var(--card-bg-color);
        }

        .card-header {
            background-color: var(--card-bg-color);
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 15px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .stat-card {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background-color: var(--card-bg-color);
            transition: transform 0.2s ease-in-out;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin: 10px 0;
            color: var(--primary-color);
        }

        .stat-card .stat-label {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .stat-card .stat-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .progress {
            height: 8px;
            margin-bottom: 10px;
            background-color: var(--background-color);
        }

        .table {
            color: var(--text-color);
        }

        .table thead th {
            border-bottom: 2px solid var(--border-color);
            color: var (--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .badge-provider {
            background-color: var(--accent-color);
            color: white;
            font-weight: normal;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }

        .badge-model {
            background-color: var(--secondary-color);
            color: white;
            font-weight: normal;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }

        .pagination .page-link {
            color: var(--primary-color);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Stats icons colors */
        .text-primary {
            color: var(--primary-color) !important;
        }

        .text-success {
            color: var(--success-color) !important;
        }

        .text-warning {
            color: var(--warning-color) !important;
        }

        .text-danger {
            color: var(--danger-color) !important;
        }

        .text-info {
            color: var(--accent-color) !important;
        }

        /* Responsive fixes */
        @media (max-width: 768px) {
            .stat-card .stat-number {
                font-size: 1.5rem;
            }

            .stat-card .stat-icon {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= site_url('usage') ?>">
                <i class="fas fa-robot me-2"></i>
                LLM Proxy Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(2) == '' || $this->uri->segment(2) == 'index' ? 'active' : '' ?>" href="<?= site_url('usage') ?>">
                            <i class="fas fa-chart-line me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(2) == 'logs' ? 'active' : '' ?>" href="<?= site_url('usage/logs') ?>">
                            <i class="fas fa-list-alt me-1"></i> Usage Logs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(2) == 'quotas' ? 'active' : '' ?>" href="<?= site_url('usage/quotas') ?>">
                            <i class="fas fa-user-shield me-1"></i> User Quotas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(2) == 'providers' ? 'active' : '' ?>" href="<?= site_url('usage/providers') ?>">
                            <i class="fas fa-server me-1"></i> Providers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(2) == 'cache' ? 'active' : '' ?>" href="<?= site_url('usage/cache') ?>">
                            <i class="fas fa-memory me-1"></i> Cache
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $this->uri->segment(1) == 'tenants' ? 'active' : '' ?>" href="<?= site_url('tenants') ?>">
                            <i class="fas fa-building me-1"></i> Tenants
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <h1 class="mb-4"><?php echo isset($title) ? $title : 'LLM Proxy Usage Dashboard'; ?></h1>