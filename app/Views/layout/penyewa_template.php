<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Penyewa' ?> | SmartKos</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        
        .navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border-bottom: 2px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            color: #6b7280;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #3b82f6;
        }

        .nav-link.active {
            color: #3b82f6;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: #3b82f6;
            border-radius: 2px;
        }

        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);
            border-right: 1px solid #e5e7eb;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .sidebar-item {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar-item a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #6b7280;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .sidebar-item a:hover {
            background-color: #f3f4f6;
            color: #3b82f6;
            transform: translateX(4px);
        }

        .sidebar-item a.active {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
        }

        .sidebar-item i {
            width: 20px;
            margin-right: 0.75rem;
            text-align: center;
        }

        .card {
            background: white;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stat-card.green {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card.yellow {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .smooth-transition { 
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); 
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .sidebar.active {
                display: block;
                position: absolute;
                left: 0;
                top: 80px;
                width: 250px;
                z-index: 20;
                box-shadow: 4px 0 12px rgba(0, 0, 0, 0.15);
            }

            .overlay.active {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 10;
            }
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="navbar sticky top-0 z-30">
        <div class="px-4 md:px-6 py-4 flex items-center justify-between">
            <!-- Brand & Menu Toggle -->
            <div class="flex items-center space-x-4">
                <button id="sidebar-toggle" class="md:hidden p-2 hover:bg-gray-100 rounded-lg smooth-transition text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-home text-white text-sm font-bold"></i>
                    </div>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">SmartKos</h1>
                </div>
            </div>

            <!-- Center Nav Links (Desktop) -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="<?= base_url('penyewa/dashboard') ?>" class="nav-link active">
                    <i class="fas fa-chart-line mr-2"></i>Dashboard
                </a>
                <a href="<?= base_url('penyewa/riwayat-booking') ?>" class="nav-link">
                    <i class="fas fa-calendar-check mr-2"></i>Booking
                </a>
                <a href="<?= base_url('penyewa/pembayaran') ?>" class="nav-link">
                    <i class="fas fa-credit-card mr-2"></i>Pembayaran
                </a>
                <a href="<?= base_url('katalog') ?>" class="nav-link">
                    <i class="fas fa-search mr-2"></i>Cari Kamar
                </a>
            </div>

            <!-- Right Section (User Profile & Logout) -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 px-3 py-2 bg-gray-100 rounded-lg">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm font-bold"></i>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold text-gray-900"><?= esc(session()->get('nama') ?? 'User') ?></p>
                        <p class="text-xs text-gray-500">Penyewa</p>
                    </div>
                </div>
                <button onclick="document.getElementById('logout-form').submit()" class="p-2 hover:bg-gray-100 rounded-lg smooth-transition text-gray-600 hover:text-red-600" title="Logout">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                </button>
                <form id="logout-form" action="<?= base_url('logout') ?>" method="POST" style="display: none;"></form>
            </div>
        </div>
    </nav>

    <!-- Overlay untuk mobile sidebar -->
    <div id="sidebar-overlay" class="overlay"></div>

    <!-- Main Container -->
    <div class="flex">
        <!-- Sidebar (Mobile & Desktop) -->
        <aside id="sidebar" class="sidebar w-full md:w-64 md:block">
            <nav class="p-4 space-y-2">
                <div class="sidebar-item">
                    <a href="<?= base_url('penyewa/dashboard') ?>" class="active">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="<?= base_url('penyewa/riwayat-booking') ?>">
                        <i class="fas fa-calendar-check"></i>
                        <span>Riwayat Booking</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="<?= base_url('penyewa/pembayaran') ?>">
                        <i class="fas fa-credit-card"></i>
                        <span>Pembayaran Saya</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="<?= base_url('katalog') ?>">
                        <i class="fas fa-search"></i>
                        <span>Cari Kamar Baru</span>
                    </a>
                </div>

                <hr class="my-4 border-gray-200">

                <div class="sidebar-item">
                    <a href="<?= base_url('logout') ?>" onclick="document.getElementById('logout-form').submit(); return false;">
                        <i class="fas fa-sign-out-alt text-red-500"></i>
                        <span class="text-red-500">Logout</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 md:flex-1">
            <div class="p-4 md:p-6 max-w-6xl mx-auto w-full">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Close sidebar on link click (mobile)
        const sidebarLinks = sidebar?.querySelectorAll('a');
        sidebarLinks?.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
