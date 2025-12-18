<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Detail Kamar' ?> | SmartKos</title>
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
        .room-header {
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

        /* Room specific styles */
        .room-image { border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(2,6,23,0.06); }
        .facility-item { background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; transition: all 0.3s; }
        .facility-item:hover { background: #f1f5f9; border-color: #667eea; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102, 126, 234, 0.1); }
        .price-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-available { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .status-booked { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
        .status-occupied { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <!-- Top Header -->
    <header class="room-header px-4 md:px-6 py-4 sticky top-0 z-20 shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="<?= base_url() ?>" class="text-gray-600 hover:text-gray-900 p-2 hover:bg-gray-100 rounded-lg smooth-transition" title="Kembali ke Beranda">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-none tracking-tight">Kamar No. <?= esc($kamar['nomor_kamar']) ?></h1>
                    <p class="text-gray-500 text-sm mt-1">Detail & Informasi Lengkap</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="<?= base_url('katalog') ?>" class="text-gray-600 hover:text-gray-900 px-4 py-2 hover:bg-gray-100 rounded-lg smooth-transition font-medium">
                    <i class="fas fa-th mr-2"></i>Katalog
                </a>
                <div class="status-badge <?=
                    $kamar['status'] == 'Tersedia' ? 'status-available' :
                    ($kamar['status'] == 'Di Booking' ? 'status-booked' : 'status-occupied')
                ?>">
                    <i class="fas fa-circle text-xs"></i>
                    <?= esc($kamar['status']) ?>
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

</body>
</html>