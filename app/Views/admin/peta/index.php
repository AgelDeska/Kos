<?= $this->extend('layout/admin_template') ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-map-marked-alt text-slate-400 mr-3"></i>Kelola Peta Lokasi Kos
            </h2>
            <p class="text-gray-600 mt-1">Atur koordinat dan alamat kos untuk ditampilkan di website</p>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
<?php if (session()->getFlashdata('errors')): ?>
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-red-500 mt-1 mr-3"></i>
            <div>
                <h4 class="font-semibold text-red-900 mb-2">Terjadi Kesalahan</h4>
                <ul class="text-sm text-red-800 space-y-1">
                    <?php foreach(session()->getFlashdata('errors') as $err): ?>
                        <li>• <?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
        <div class="flex items-start">
            <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
            <div>
                <p class="font-semibold text-green-900"><?= session()->getFlashdata('success') ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Location Form -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-slate-50">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    Set Lokasi Kos
                </h3>
            </div>

            <div class="p-6">
                <form action="<?= base_url('admin/peta/update') ?>" method="post" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- Latitude & Longitude Row -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-globe text-blue-500 mr-2"></i>Latitude
                            </label>
                            <input type="text"
                                   name="latitude"
                                   value="<?= esc($latitude) ?>"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-sm"
                                   placeholder="-6.208763">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-globe text-blue-500 mr-2"></i>Longitude
                            </label>
                            <input type="text"
                                   name="longitude"
                                   value="<?= esc($longitude) ?>"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-sm"
                                   placeholder="106.845599">
                        </div>
                    </div>

                    <!-- Address Input -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-home text-blue-500 mr-2"></i>Alamat Lengkap Kos
                        </label>
                        <textarea name="address"
                                  rows="4"
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 text-sm resize-none"
                                  placeholder="Jl. Contoh No. 123, Kelurahan, Kecamatan, Kota, Provinsi, Kode Pos"><?= esc($address) ?></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-xl transition duration-200 transform hover:scale-105 shadow-lg flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i>Simpan Lokasi
                        </button>
                        <button type="button"
                                onclick="getCurrentLocation()"
                                class="px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition duration-200 flex items-center justify-center"
                                title="Dapatkan lokasi saat ini">
                            <i class="fas fa-crosshairs"></i>
                        </button>
                    </div>
                </form>

                <!-- Info Card -->
                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-blue-900 mb-1">Tips Penggunaan</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• Klik marker untuk melihat detail</li>
                                <li>• Drag marker untuk mengubah posisi</li>
                                <li>• Gunakan tombol crosshairs untuk lokasi saat ini</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Preview -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-slate-50 to-blue-50">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <div class="w-10 h-10 bg-slate-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-map text-white"></i>
                    </div>
                    Preview Peta Lokasi
                </h3>
            </div>

            <div class="p-6">
                <!-- Map Stats -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                        <div class="text-2xl font-bold text-blue-600 mb-1"><?= number_format($latitude, 4) ?></div>
                        <div class="text-xs font-semibold text-blue-700 uppercase tracking-wider">Latitude</div>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200">
                        <div class="text-2xl font-bold text-slate-600 mb-1"><?= number_format($longitude, 4) ?></div>
                        <div class="text-xs font-semibold text-slate-700 uppercase tracking-wider">Longitude</div>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border border-green-200">
                        <div class="text-lg font-bold text-green-600 mb-1">Aktif</div>
                        <div class="text-xs font-semibold text-green-700 uppercase tracking-wider">Status</div>
                    </div>
                </div>

                <!-- Map Container -->
                <div class="relative">
                    <div id="map" class="w-full h-96 rounded-xl border-2 border-gray-200 shadow-inner"></div>

                    <!-- Map Controls -->
                    <div class="absolute top-4 right-4 flex flex-col gap-2">
                        <button onclick="resetMapView()"
                                class="bg-white hover:bg-gray-50 text-gray-700 p-2 rounded-lg shadow-md border border-gray-200 transition duration-200"
                                title="Reset View">
                            <i class="fas fa-home"></i>
                        </button>
                        <button onclick="toggleFullscreen()"
                                class="bg-white hover:bg-gray-50 text-gray-700 p-2 rounded-lg shadow-md border border-gray-200 transition duration-200"
                                title="Fullscreen">
                            <i class="fas fa-expand"></i>
                        </button>
                    </div>
                </div>

                <!-- Address Display -->
                <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <div class="flex items-start">
                        <i class="fas fa-map-pin text-gray-500 mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Alamat Saat Ini</h4>
                            <p class="text-sm text-gray-700 leading-relaxed"><?= esc($address) ?: 'Belum diatur' ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let map, marker;
    const defaultLat = <?= $latitude ?: -6.208763 ?>;
    const defaultLng = <?= $longitude ?: 106.845599 ?>;

    // Initialize map
    function initMap(lat = defaultLat, lng = defaultLng) {
        if (map) map.remove();

        map = L.map('map', {
            center: [lat, lng],
            zoom: 15,
            zoomControl: true,
            scrollWheelZoom: true
        });

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Add marker with custom icon
        const customIcon = L.divIcon({
            html: '<div class="w-8 h-8 bg-red-500 rounded-full border-4 border-white shadow-lg flex items-center justify-center"><i class="fas fa-home text-white text-xs"></i></div>',
            className: 'custom-marker',
            iconSize: [32, 32],
            iconAnchor: [16, 16]
        });

        marker = L.marker([lat, lng], {
            icon: customIcon,
            draggable: true
        }).addTo(map);

        // Enhanced popup
        const popupContent = `
            <div class="text-center">
                <div class="font-bold text-gray-900 mb-1">Lokasi Kos SmartKos</div>
                <div class="text-sm text-gray-600 mb-2">${<?= json_encode($address) ?> || 'Alamat belum diatur'}</div>
                <div class="text-xs text-gray-500">
                    Koordinat: ${lat.toFixed(6)}, ${lng.toFixed(6)}
                </div>
            </div>
        `;

        marker.bindPopup(popupContent).openPopup();

        // Update form when marker is dragged
        marker.on('dragend', function(e) {
            const latlng = e.target.getLatLng();
            document.querySelector('input[name="latitude"]').value = latlng.lat.toFixed(6);
            document.querySelector('input[name="longitude"]').value = latlng.lng.toFixed(6);

            // Update popup
            const newPopupContent = `
                <div class="text-center">
                    <div class="font-bold text-gray-900 mb-1">Lokasi Kos SmartKos</div>
                    <div class="text-sm text-gray-600 mb-2">${<?= json_encode($address) ?> || 'Alamat belum diatur'}</div>
                    <div class="text-xs text-gray-500">
                        Koordinat: ${latlng.lat.toFixed(6)}, ${latlng.lng.toFixed(6)}
                    </div>
                </div>
            `;
            marker.setPopupContent(newPopupContent);

            // Update stats display
            updateStatsDisplay(latlng.lat, latlng.lng);
        });
    }

    // Initialize map
    initMap();

    // Get current location
    window.getCurrentLocation = function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Update form
                document.querySelector('input[name="latitude"]').value = lat.toFixed(6);
                document.querySelector('input[name="longitude"]').value = lng.toFixed(6);

                // Update map
                initMap(lat, lng);
                updateStatsDisplay(lat, lng);

                // Show success message
                showNotification('Lokasi saat ini berhasil didapatkan!', 'success');
            }, function(error) {
                showNotification('Gagal mendapatkan lokasi: ' + error.message, 'error');
            });
        } else {
            showNotification('Geolocation tidak didukung browser ini', 'error');
        }
    };

    // Reset map view
    window.resetMapView = function() {
        const lat = parseFloat(document.querySelector('input[name="latitude"]').value) || defaultLat;
        const lng = parseFloat(document.querySelector('input[name="longitude"]').value) || defaultLng;
        initMap(lat, lng);
    };

    // Toggle fullscreen (simple implementation)
    window.toggleFullscreen = function() {
        const mapContainer = document.getElementById('map');
        if (mapContainer.requestFullscreen) {
            mapContainer.requestFullscreen();
        }
    };

    // Update stats display
    function updateStatsDisplay(lat, lng) {
        const latElements = document.querySelectorAll('.stat-lat');
        const lngElements = document.querySelectorAll('.stat-lng');

        latElements.forEach(el => el.textContent = lat.toFixed(4));
        lngElements.forEach(el => el.textContent = lng.toFixed(4));
    }

    // Show notification
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-green-50 border-green-500 text-green-900',
            error: 'bg-red-50 border-red-500 text-red-900',
            info: 'bg-blue-50 border-blue-500 text-blue-900'
        };

        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg border-l-4 shadow-lg z-50 ${colors[type]}`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} mr-3"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>

<?= $this->endSection() ?>