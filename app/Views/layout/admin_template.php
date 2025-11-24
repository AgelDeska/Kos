<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SmartKos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .sidebar { 
            position: fixed; top: 0; bottom: 0; left: 0; 
            z-index: 1000; padding: 48px 0 0; box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1); 
            background-color: #343a40; color: white;
        }
        .sidebar-sticky { position: relative; top: 0; height: calc(100vh - 48px); overflow-x: hidden; overflow-y: auto; }
        .main-content { margin-left: 240px; }
        .sidebar a { color: #dee2e6; padding: 10px 15px; display: block; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; color: white; }
        .sidebar .active { color: #ffc107; border-left: 3px solid #ffc107; background-color: #495057; }
        .navbar-brand { color: white !important; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/admin/dashboard">SmartKos Admin</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span><?= session()->get('role') ?> Menu</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>" href="/admin/dashboard"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
                    
                    <?php if (session()->get('role') == 'Admin'): ?>
                        <li class="nav-item"><a class="nav-link <?= uri_string() == 'admin/kamar' ? 'active' : '' ?>" href="/admin/kamar"><i class="bi bi-grid-fill"></i> Kelola Kamar</a></li>
                        <li class="nav-item"><a class="nav-link <?= uri_string() == 'admin/penyewa' ? 'active' : '' ?>" href="/admin/penyewa"><i class="bi bi-person-badge-fill"></i> Kelola Penyewa</a></li>
                        <li class="nav-item"><a class="nav-link <?= uri_string() == 'admin/booking' ? 'active' : '' ?>" href="/admin/booking"><i class="bi bi-calendar-check-fill"></i> Verifikasi Booking</a></li>
                        <li class="nav-item"><a class="nav-link <?= uri_string() == 'admin/pembayaran' ? 'active' : '' ?>" href="/admin/pembayaran"><i class="bi bi-currency-dollar"></i> Kelola Pembayaran</a></li>
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"><span>Laporan</span></h6>
                        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan Keuangan</a></li>
                    <?php endif; ?>

                    <?php if (session()->get('role') == 'Penyewa'): ?>
                        <li class="nav-item"><a class="nav-link <?= uri_string() == 'penyewa/riwayat-booking' ? 'active' : '' ?>" href="/penyewa/riwayat-booking"><i class="bi bi-clock-history"></i> Riwayat Booking</a></li>
                        <li class="nav-item"><a class="nav-link" href="/penyewa/pembayaran"><i class="bi bi-cash-stack"></i> Pembayaran Saya</a></li>
                    <?php endif; ?>
                    
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><?= $title ?? 'Dashboard' ?></h1>
            </div>
            <?= view('layout/alert_message') ?>
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>