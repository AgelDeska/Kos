<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Profil' ?> | SmartKos</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Header styling */
        .profile-header {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background: rgba(255,255,255,0.85);
            border-bottom: 1px solid #e2e8f0;
        }

        .smooth-transition { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }

        /* Common card + button styles */
        .card { background: #fff; border-radius: 12px; border: 1px solid rgba(15,23,42,0.04); box-shadow: 0 8px 24px rgba(2,6,23,0.06); overflow: hidden; }
        .card .card-header { padding: 1rem 1.25rem; border-bottom: 1px solid rgba(15,23,42,0.04); }
        .card .card-body { padding: 1rem 1.25rem; }

        .btn { display: inline-flex; align-items: center; gap: 8px; padding: .5rem .9rem; border-radius: 10px; font-weight:600; cursor:pointer; }
        .btn-primary { background: linear-gradient(90deg,#2563eb,#1d4ed8); color:#fff; box-shadow: 0 8px 20px rgba(37,99,235,0.16); }
        .btn-ghost { background: transparent; border:1px solid rgba(15,23,42,0.06); color:#0f172a; }
        .btn-danger { background: linear-gradient(90deg,#ef4444,#dc2626); color:#fff; }
        .btn-sm { padding:.35rem .6rem; font-size: .9rem; border-radius:8px; }

        /* Profile specific styles */
        .profile-avatar { width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; font-weight: 800; border: 4px solid white; box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3); }
        .info-box { background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; transition: all 0.3s; }
        .info-box:hover { background: #f1f5f9; border-color: #667eea; }
        .info-label { font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .info-value { font-size: 1rem; font-weight: 700; color: #1e293b; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <!-- Top Header -->
    <header class="profile-header px-4 md:px-6 py-4 sticky top-0 z-20 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="<?= base_url() ?>" class="text-gray-600 hover:text-gray-900 p-2 hover:bg-gray-100 rounded-lg smooth-transition" title="Kembali ke Beranda">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-none tracking-tight"><?= $title ?? 'Profil' ?></h1>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm md:text-base text-gray-600 font-medium hidden sm:inline">Panel Pengguna</span>
                <div class="relative" id="profileWrapper">
                    <button type="button" id="profileBtn" title="Menu" class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-md hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-user text-white"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden z-30">
                        <div class="px-4 py-3 text-sm">
                            <p class="font-semibold text-gray-900"><?= session()->get('nama') ?? 'Pengguna' ?></p>
                            <p class="text-gray-500">@<?= session()->get('username') ?? 'user' ?></p>
                        </div>
                        <div class="border-t border-gray-200"></div>
                        <a href="<?= base_url('profile/edit') ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-edit text-gray-500 w-4"></i>
                            <span>Edit Profil</span>
                        </a>
                        <a href="<?= base_url('penyewa/dashboard') ?>" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-tachometer-alt text-gray-500 w-4"></i>
                            <span>Dashboard</span>
                        </a>
                        <button id="logoutAction" class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-4"></i>
                            <span>Keluar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="pb-8">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <script>
        // Profile dropdown & logout confirm
        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.getElementById('profileMenu');
        const logoutAction = document.getElementById('logoutAction');

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
            if (confirm('Anda yakin ingin keluar?')) {
                // Submit logout form
                const logoutForm = document.createElement('form');
                logoutForm.method = 'POST';
                logoutForm.action = '<?= base_url('logout') ?>';
                document.body.appendChild(logoutForm);
                logoutForm.submit();
            }
        });
    </script>
</body>
</html>