<?php $uri = service('uri'); $seg2 = $uri->getSegment(2) ?? 'dashboard'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Admin' ?> | SmartKos</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        
        .sidebar { 
            transition: all 0.3s ease;
            background: linear-gradient(180deg, #111827 0%, #0b1220 100%);
        }
        .sidebar-item { 
            transition: all 0.2s ease;
            border-radius: 0.5rem;
        }
        .sidebar-item:hover { 
            background-color: rgba(59, 130, 246, 0.10);
            transform: translateX(2px);
        }
        .sidebar-item a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .sidebar-item a:hover { color: #fff; }
        .sidebar-item a.active {
            background: linear-gradient(90deg, rgba(59,130,246,0.25) 0%, rgba(37,99,235,0.15) 100%);
            color: #fff;
            border-left: 3px solid #3b82f6;
            padding-left: calc(1rem - 3px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.04);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
        
        /* Header styling */
        .admin-header {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background: rgba(255,255,255,0.85);
            border-bottom: 1px solid #e2e8f0;
        }
        
        .smooth-transition { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        /* Common card + button styles for admin */
        .card { background: #fff; border-radius: 12px; border: 1px solid rgba(15,23,42,0.04); box-shadow: 0 8px 24px rgba(2,6,23,0.06); overflow: hidden; }
        .card .card-header { padding: 1rem 1.25rem; border-bottom: 1px solid rgba(15,23,42,0.04); }
        .card .card-body { padding: 1rem 1.25rem; }

        .btn { display: inline-flex; align-items: center; gap: 8px; padding: .5rem .9rem; border-radius: 10px; font-weight:600; cursor:pointer; }
        .btn-primary { background: linear-gradient(90deg,#2563eb,#1d4ed8); color:#fff; box-shadow: 0 8px 20px rgba(37,99,235,0.16); }
        .btn-ghost { background: transparent; border:1px solid rgba(15,23,42,0.06); color:#0f172a; }
        .btn-danger { background: linear-gradient(90deg,#ef4444,#dc2626); color:#fff; }
        .btn-sm { padding:.35rem .6rem; font-size: .9rem; border-radius:8px; }

        /* Table helpers */
        .table-styled thead th { background: #f8fafc; position: sticky; top:0; z-index:1; }
        .table-styled tbody tr:hover { background: #fbfdff; }
        .table-styled td, .table-styled th { padding: .9rem 1rem; }

        /* Simple modal (centered) */
        .modal-backdrop { position: fixed; inset:0; background: rgba(2,6,23,0.5); display:flex; align-items:center; justify-content:center; z-index:60; }
        .modal { background:#fff; border-radius:12px; padding:18px; max-width:520px; width:100%; box-shadow:0 18px 40px rgba(2,6,23,0.25); }
    </style>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar w-64 text-gray-100 flex flex-col h-full z-30 shadow-2xl">
        <!-- Logo Section -->
        <div class="p-6 border-b border-gray-800 bg-gradient-to-br from-blue-600 to-blue-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                    <i class="fas fa-key text-blue-600 text-lg font-bold"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">SmartKos</h1>
                    <p class="text-xs text-blue-100">Admin Panel</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1 px-3">
                <li class="sidebar-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="<?= ($seg2==='dashboard') ? 'active' : '' ?>">
                        <i class="fas fa-chart-line w-5 text-blue-400"></i>
                        <span class="ml-3 font-medium">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= base_url('admin/kamar') ?>" class="<?= ($seg2==='kamar') ? 'active' : '' ?>">
                        <i class="fas fa-door-open w-5 text-blue-500"></i>
                        <span class="ml-3 font-medium">Kelola Kamar</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= base_url('admin/penyewa') ?>" class="<?= ($seg2==='penyewa') ? 'active' : '' ?>">
                        <i class="fas fa-users w-5 text-blue-600"></i>
                        <span class="ml-3 font-medium">Kelola Penyewa</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= base_url('admin/booking') ?>" class="<?= ($seg2==='booking') ? 'active' : '' ?>">
                        <i class="fas fa-calendar-check w-5 text-blue-700"></i>
                        <span class="ml-3 font-medium">Verifikasi Booking</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= base_url('admin/pembayaran') ?>" class="<?= ($seg2==='pembayaran') ? 'active' : '' ?>">
                        <i class="fas fa-credit-card w-5 text-blue-800"></i>
                        <span class="ml-3 font-medium">Kelola Pembayaran</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= base_url('admin/peta') ?>" class="<?= ($seg2==='peta') ? 'active' : '' ?>">
                        <i class="fas fa-map-marked-alt w-5 text-slate-400"></i>
                        <span class="ml-3 font-medium">Kelola Peta Lokasi</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Bottom Section -->
        <div class="p-4 border-t border-gray-800 space-y-3">
            <button onclick="document.getElementById('logout-form').submit()" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg smooth-transition flex items-center justify-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
            <form id="logout-form" action="<?= base_url('auth/logout') ?>" method="POST" style="display: none;"></form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex flex-col flex-1 overflow-hidden">
        <!-- Top Header -->
        <header class="admin-header px-4 md:px-6 py-4 flex flex-col gap-3 sticky top-0 z-20 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button id="sidebar-toggle" class="text-gray-600 hover:text-gray-900 lg:hidden p-2 hover:bg-gray-100 rounded-lg smooth-transition" aria-label="Toggle Sidebar">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-none tracking-tight"><?= $title ?? 'Dashboard' ?></h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm md:text-base text-gray-600 font-medium hidden sm:inline">Admin Panel</span>
                    <div class="relative" id="profileWrapper">
                        <button type="button" id="profileBtn" title="Akun" class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-md hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-user-shield text-white"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden z-30">
                            <div class="px-4 py-3 text-sm">
                                <p class="font-semibold text-gray-900">Admin</p>
                                <p class="text-gray-500">Panel</p>
                            </div>
                            <div class="border-t border-gray-200"></div>
                            <a href="<?= base_url('profile') ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-user-circle text-gray-500 w-4"></i>
                                <span>Profil</span>
                            </a>
                            <button id="logoutAction" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                <span>Keluar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumbs -->
            <nav class="hidden md:flex items-center text-sm text-gray-500">
                <a href="<?= base_url('admin/dashboard') ?>" class="hover:text-blue-600 inline-flex items-center gap-2"><i class="fas fa-home"></i>Dashboard</a>
                <?php if (!empty($title) && strtolower($title) !== 'dashboard'): ?>
                    <i class="fas fa-chevron-right mx-2 text-gray-400"></i>
                    <span class="text-gray-700 font-medium"><?= esc($title) ?></span>
                <?php endif; ?>
            </nav>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="p-4 md:p-6 max-w-7xl mx-auto w-full">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.flex-1');
        const toggleButton = document.getElementById('sidebar-toggle');

        // Initial setup for mobile (sidebar hidden)
        if (window.innerWidth < 1024) {
            sidebar.classList.add('hidden', '-translate-x-full');
            if (mainContent) mainContent.style.marginLeft = '0';
        }

        toggleButton?.addEventListener('click', () => {
            if (sidebar.classList.contains('hidden')) {
                // Show sidebar
                sidebar.classList.remove('hidden', '-translate-x-full');
                sidebar.classList.add('absolute', 'top-0', 'left-0');
            } else {
                // Hide sidebar
                sidebar.classList.add('hidden', '-translate-x-full');
                sidebar.classList.remove('absolute', 'top-0', 'left-0');
            }
        });

        // Responsive behavior
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('hidden', '-translate-x-full', 'absolute', 'top-0', 'left-0');
                if (mainContent) mainContent.style.marginLeft = '0';
            } else if (window.innerWidth < 1024 && !sidebar.classList.contains('hidden')) {
                sidebar.classList.add('hidden', '-translate-x-full', 'absolute', 'top-0', 'left-0');
            }
        });

        // Profile dropdown & logout confirm
        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.getElementById('profileMenu');
        const logoutAction = document.getElementById('logoutAction');
        const logoutForm = document.getElementById('logout-form');

        function closeProfileMenu() { profileMenu?.classList.add('hidden'); }

        profileBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu?.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profileMenu || !profileBtn) return;
            if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                closeProfileMenu();
            }
        }, { passive: true });

        logoutAction?.addEventListener('click', () => {
            closeProfileMenu();
            if (confirm('Anda yakin ingin keluar dari admin panel?')) {
                logoutForm?.submit();
            }
        });

        // Generic data-confirm handler for links/buttons
        document.addEventListener('click', function (e) {
            const el = e.target.closest('[data-confirm]');
            if (!el) return;
            e.preventDefault();
            const message = el.getAttribute('data-confirm') || 'Apakah Anda yakin?';
            const href = el.getAttribute('href');
            const formMethod = el.getAttribute('data-method') || 'GET';

            // Show native confirm for now
            if (confirm(message)) {
                if (href) window.location = href;
                else {
                    // If meant to submit a form, attempt to find target
                    const target = document.querySelector(el.getAttribute('data-target'));
                    if (target && target.tagName === 'FORM') target.submit();
                }
            }
        });
    </script>
</body>
</html>
