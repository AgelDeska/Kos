<?= $this->extend('layout/public_template') ?>

<?= $this->section('content') ?>

<!-- Clean, professional hero with CTA -->
<section id="hero" class="hero" aria-label="Hero - SmartKos">
  <div class="container">
    <h1>Hunian Modern, Proses Transparan, Tinggal Nyaman</h1>
    <p class="mt-4">Cari, booking, dan bayar kamar kos secara digital — cepat, aman, dan tanpa repot. Ideal untuk mahasiswa, pekerja, dan profesional muda.</p>

    <div style="margin-top:28px; display:flex; gap:14px; justify-content:center;">
      <a href="<?= base_url('katalog') ?>" class="btn-main" aria-label="Lihat Katalog">Lihat Kamar</a>
      <a href="<?= base_url('katalog') ?>#contact" class="btn-main" style="background:transparent;color:#fff;border:1px solid rgba(255,255,255,0.12);">Hubungi Kami</a>
    </div>
    </div>
  </div>
</section>

<!-- About / Value Proposition -->
<section id="about" class="about">
  <div class="container" style="display:flex; gap:36px; align-items:center; flex-wrap:wrap;">
    <div style="flex:1; min-width:320px;">
      <h2 class="section-title">Solusi Hunian Modern Untuk Anda</h2>
      <p class="section-subtitle">SmartKos menggabungkan kemudahan pencarian, transparansi biaya, dan proses pembayaran terintegrasi agar Anda dapat fokus pada aktivitas sehari-hari tanpa khawatir urusan kos.</p>

      <ul style="display:grid; grid-template-columns:repeat(2, minmax(0,1fr)); gap:12px; list-style:none; padding:0; margin-top:18px;">
        <li style="display:flex; gap:12px; align-items:flex-start;"><i class="fas fa-check-circle" style="color:var(--primary-color); margin-top:6px"></i> Booking online & konfirmasi cepat</li>
        <li style="display:flex; gap:12px; align-items:flex-start;"><i class="fas fa-check-circle" style="color:var(--primary-color); margin-top:6px"></i> Fasilitas lengkap & terawat</li>
        <li style="display:flex; gap:12px; align-items:flex-start;"><i class="fas fa-check-circle" style="color:var(--primary-color); margin-top:6px"></i> Pembayaran terverifikasi</li>
        <li style="display:flex; gap:12px; align-items:flex-start;"><i class="fas fa-check-circle" style="color:var(--primary-color); margin-top:6px"></i> Dukungan administrasi 24/7</li>
      </ul>
    </div>

    <div style="flex:1; min-width:280px; display:flex; justify-content:center;">
      <img src="<?= base_url('img/kos/depankos.jpeg') ?>" alt="Interior kamar modern" style="width:520px; max-width:100%; height:360px; object-fit:cover; border-radius:12px; box-shadow:var(--card-shadow)">
    </div>
  </div>
</section>

<!-- Key Benefits / Features -->
<section id="reasons" class="reasons">
  <div class="container">
    <h2 class="section-title">Keunggulan SmartKos</h2>
    <p class="section-subtitle">Desain hunian yang rapi, proses digital, dan dukungan pemilik kos untuk kenyamanan Anda.</p>

    <div class="reason-cards" style="margin-top:18px;">
      <div class="card"><i class="fas fa-wifi"></i><h3>Koneksi Stabil</h3><p>Wi‑Fi yang cukup untuk belajar dan kerja.</p></div>
      <div class="card"><i class="fas fa-couch"></i><h3>Furnitur Lengkap</h3><p>Meja, lemari, kasur kualitas baik.</p></div>
      <div class="card"><i class="fas fa-shield-alt"></i><h3>Keamanan</h3><p>Lingkungan terawat dan aturan jelas.</p></div>
      <div class="card"><i class="fas fa-money-bill-wave"></i><h3>Pembayaran Mudah</h3><p>Riwayat dan bukti pembayaran tersimpan rapi.</p></div>
    </div>
  </div>
</section>

<!-- How It Works -->
<section id="how" style="padding:64px 0;">
  <div class="container">
    <h2 class="section-title">Cara Kerjanya</h2>
    <p class="section-subtitle">Cukup tiga langkah sederhana untuk mulai tinggal di SmartKos.</p>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px,1fr)); gap:20px; margin-top:18px;">
      <div class="card" style="text-align:center; padding:26px;"><div style="font-size:28px; color:var(--primary-color);">1</div><h3>Pilih Kamar</h3><p>Pilih kamar berdasarkan lokasi dan fasilitas.</p></div>
      <div class="card" style="text-align:center; padding:26px;"><div style="font-size:28px; color:var(--primary-color);">2</div><h3>Booking & Bayar</h3><p>Booking online dan unggah bukti pembayaran DP.</p></div>
      <div class="card" style="text-align:center; padding:26px;"><div style="font-size:28px; color:var(--primary-color);">3</div><h3>Check-in</h3><p>Konfirmasi admin lalu masuk hunian dengan tenang.</p></div>
    </div>
  </div>
</section>

<!-- Gallery -->
<section id="gallery" class="gallery">
  <div class="container">
    <h2 class="section-title">Galeri Pilihan</h2>
    <p class="section-subtitle">Beberapa contoh kamar dan ruang bersama yang tersedia.</p>

    <div class="gallery-grid">
      <img src="<?= base_url('img/kos/depankos.jpeg') ?>" alt="Kamar 1">
      <img src="<?= base_url('img/kos/dalam_kamar.jpeg') ?>" alt="Kamar 2">
      <img src="<?= base_url('img/kos/depan_kamar.jpeg') ?>" alt="Ruang Bersama">
      <img src="<?= base_url('img/kos/toilet.jpeg') ?>" alt="Dapur Bersama">
    </div>
  </div>
</section>

<!-- Testimonials -->
<section id="testimonials" class="testimonials">
  <div class="container">
    <h2 class="section-title">Testimoni Penghuni</h2>
    <p class="section-subtitle">Pendapat penghuni yang sudah merasakan layanan kami.</p>

    <div class="testimonial-cards">
      <div class="testimonial"><i class="fas fa-quote-left quote-icon"></i><p>"Kamar nyaman, proses cepat, admin ramah. Sangat rekomendasi untuk mahasiswa."</p><h4>— Ayu, Mahasiswa</h4></div>
      <div class="testimonial"><i class="fas fa-quote-left quote-icon"></i><p>"Pembayaran dan bukti tersimpan rapi; proses verifikasi cepat."</p><h4>— Budi, Karyawan</h4></div>
      <div class="testimonial"><i class="fas fa-quote-left quote-icon"></i><p>"Lokasi strategis, akses mudah ke kampus dan kantor."</p><h4>— Rina, Freelancer</h4></div>
    </div>
  </div>
</section>

<!-- Contact / CTA -->
<section id="contact" class="contact">
  <div class="container">
    <h2 class="section-title">Siap Memulai?</h2>
    <p class="section-subtitle">Hubungi admin untuk tur kamar atau buka katalog untuk melihat pilihan lengkap.</p>

    <div style="display:grid; grid-template-columns: 1fr 360px; gap:24px; align-items:start;">
      <div>
        <div class="info-box" style="margin-bottom:12px; display:flex; gap:14px; align-items:flex-start;">
          <i class="fas fa-map-marker-alt" style="font-size:28px; color:var(--primary-color);"></i>
          <div><strong>Alamat</strong><div style="color:var(--muted-color);">Jl. Kebenaran No.08, Kurao Pagang, Nanggalo</div></div>
        </div>
        <div class="info-box" style="margin-bottom:12px; display:flex; gap:14px; align-items:flex-start;">
          <i class="fas fa-phone-alt" style="font-size:28px; color:var(--primary-color);"></i>
          <div><strong>Telepon</strong><div style="color:var(--muted-color);">+62 812 3456 7890</div></div>
        </div>
        <div class="info-box" style="display:flex; gap:14px; align-items:flex-start;">
          <i class="fas fa-envelope" style="font-size:28px; color:var(--primary-color);"></i>
          <div><strong>Email</strong><div style="color:var(--muted-color);">info@smartkos-agezitomik.com</div></div>
        </div>
      </div>

      <div style="background:var(--card-bg); border-radius:12px; padding:18px; border:1px solid var(--card-border); box-shadow:var(--card-shadow);">
        <h3 style="margin:0 0 12px;">Minta Info / Jadwalkan Survey</h3>
        <form action="<?= base_url('contact/send') ?>" method="post" class="space-y-4">
          <div><input type="text" name="nama" placeholder="Nama lengkap" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #e6eef8;"></div>
          <div><input type="email" name="email" placeholder="Email" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #e6eef8;"></div>
          <div><input type="text" name="telepon" placeholder="No. Telepon" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #e6eef8;"></div>
          <div><textarea name="pesan" rows="4" placeholder="Pesan singkat" style="width:100%; padding:10px; border-radius:8px; border:1px solid #e6eef8;"></textarea></div>
          <div style="text-align:right;"><button type="submit" class="btn-main">Kirim Permintaan</button></div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- Lokasi Kos -->
<section id="location" class="location" style="padding:60px 0; background:#f8fafc;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Lokasi Kos Kami</h2>
      <p class="section-subtitle">Temukan lokasi strategis kos kami yang mudah diakses dari berbagai titik kota.</p>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div style="height:400px; border-radius:12px; overflow:hidden; box-shadow:var(--card-shadow);" id="map-home"></div>
      </div>
      <div class="col-lg-6">
        <div style="background:#fff; padding:30px; border-radius:12px; box-shadow:var(--card-shadow); height:100%; display:flex; flex-direction:column; justify-content:center;">
          <h4 style="color:#223; margin-bottom:16px;">Alamat Kos</h4>
          <p style="color:#64748b; font-size:16px; margin-bottom:20px; line-height:1.6;">
            <i class="fas fa-map-marker-alt" style="color:var(--primary-color); margin-right:8px;"></i>
            <?= esc($kos_address) ?>
          </p>
          <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <div style="background:#f1f5f9; padding:12px 16px; border-radius:8px; text-align:center; flex:1; min-width:120px;">
              <div style="font-weight:800; font-size:18px; color:#223;">Latitude</div>
              <div style="color:#64748b; font-size:14px;"><?= esc($kos_latitude) ?></div>
            </div>
            <div style="background:#f1f5f9; padding:12px 16px; border-radius:8px; text-align:center; flex:1; min-width:120px;">
              <div style="font-weight:800; font-size:18px; color:#223;">Longitude</div>
              <div style="color:#64748b; font-size:14px;"><?= esc($kos_longitude) ?></div>
            </div>
          </div>
          <div style="margin-top:24px;">
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?= urlencode($kos_address) ?>" target="_blank" class="btn-main" style="text-decoration:none; display:inline-block;">
              <i class="fas fa-directions"></i> Petunjuk Arah
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Leaflet CSS & JS for home map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize home map
    var mapHome = L.map('map-home').setView([<?= $kos_latitude ?>, <?= $kos_longitude ?>], 15);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapHome);

    // Add marker
    L.marker([<?= $kos_latitude ?>, <?= $kos_longitude ?>]).addTo(mapHome)
        .bindPopup('<strong>SmartKos</strong><br><?= esc($kos_address) ?>')
        .openPopup();
});
</script>

<?= $this->endSection() ?>
