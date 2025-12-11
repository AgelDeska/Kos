# Dashboard Penyewa vs Admin - Perbandingan

## 📊 Struktur Tampilan

### Dashboard Admin
- **Template**: `layout/admin_template.php`
- **Sidebar**: Dark Mode dengan navigasi vertikal di kiri
- **Konten**: Fokus pada data dan kontrol manajemen
- **Warna**: Dark theme (hijau-biru)
- **Fungsi**: Kelola kamar, penyewa, booking, pembayaran

### Dashboard Penyewa
- **Template**: `layout/penyewa_template.php` (BARU)
- **Navbar**: Top horizontal navigation, clean & modern
- **Sidebar**: Slim side navigation dengan pilihan penting
- **Konten**: Fokus pada aktivitas personal dan kemudahan
- **Warna**: Light theme dengan aksen biru
- **Fungsi**: Lihat booking, cek pembayaran, cari kamar

---

## 🎨 Fitur Tampilar Penyewa

### 1. **Responsive Design**
✅ Mobile-first approach
✅ Hamburger menu untuk mobile
✅ Overlay untuk sidebar mobile
✅ Smooth transitions & animations

### 2. **Dashboard Penyewa** (`app/Views/penyewa/dashboard.php`)
- Welcome banner dengan gradient
- 4 stat cards: Total Booking, Pembayaran Pending, Terverifikasi, Jatuh Tempo
- Quick actions card: Cari Kamar, Lihat Booking, Pembayaran, Ubah Password
- Info Akun: Nama, Email, Status
- Riwayat Booking Terbaru dalam tabel

### 3. **Riwayat Booking** (`app/Views/penyewa/riwayat_booking.php`)
- Search & filter booking
- Booking cards dengan detail lengkap
- Status badge dengan color coding
- Quick actions (Bayar DP, Bayar Cicilan, Lihat Detail)
- Empty state dengan CTA

### 4. **Pembayaran** (`app/Views/penyewa/pembayaran.php`)
- Summary cards: Total Hutang, Sudah Dibayar, Sisa Hutang
- Riwayat pembayaran dengan status
- Informasi metode pembayaran (Bank + E-Wallet)
- Upload bukti pembayaran

---

## 🎯 Warna & Styling

### Color Scheme
```
Primary: Blue (#3b82f6)
Success: Green (#10b981)
Warning: Yellow (#f59e0b)
Danger: Red (#ef4444)
Info: Cyan (#06b6d4)
Background: Light Gray (#f3f4f6)
```

### Card Styling
- White background dengan border subtle
- Rounded corners (0.75rem)
- Smooth hover effects
- Box shadow dengan elevation

### Badge System
```
badge-success: Green background ✓
badge-warning: Yellow background ⏳
badge-danger: Red background ✗
badge-info: Blue background ℹ️
```

---

## 📱 Responsive Breakpoints

| Device | Width | Layout |
|--------|-------|--------|
| Mobile | < 768px | Single column, hamburger sidebar |
| Tablet | 768px - 1024px | 2 columns, visible sidebar |
| Desktop | > 1024px | Full layout, expanded sidebar |

---

## 🔗 Navigation Structure

### Navbar (Top)
- Logo & Brand
- Nav Links (Desktop) dengan active indicator
- User Profile
- Logout Button

### Sidebar (Left/Drawer)
- Dashboard
- Riwayat Booking
- Pembayaran
- Cari Kamar Baru
- Logout

---

## 🚀 Features

### 1. Search & Filter
- Live search untuk booking
- Status filter dropdown
- Client-side filtering

### 2. Status Management
- Menunggu (Yellow)
- Diterima (Blue)
- Aktif (Green)
- Selesai (Red)

### 3. Quick Actions
- Bayar DP (untuk booking diterima)
- Bayar Cicilan (untuk booking aktif)
- Lihat Detail
- Cari Kamar Baru

### 4. Info Display
- Kamar info dengan tipe
- Tanggal booking dengan waktu
- Durasi sewa
- Tanggal mulai & berakhir

---

## 📁 Files Created/Modified

✅ **NEW FILES:**
- `app/Views/layout/penyewa_template.php` - Template khusus penyewa
- `app/Views/penyewa/pembayaran.php` - Halaman pembayaran penyewa

✅ **MODIFIED FILES:**
- `app/Views/penyewa/dashboard.php` - Updated dengan template baru
- `app/Views/penyewa/riwayat_booking.php` - Updated dengan template baru

---

## 🎓 Perbedaan Utama

| Aspek | Admin | Penyewa |
|-------|-------|---------|
| Layout | Sidebar Dark | Navbar Top Light |
| Focus | Management | Personal Use |
| Data | Semua User | Own Only |
| Actions | Create/Edit/Delete | View/Upload |
| Theme | Professional | User-Friendly |
| Navigation | Vertical | Horizontal + Vertical |

---

## 💡 Tips Penggunaan

1. **Login sebagai Penyewa**: Gunakan `penyewa1 / penyewa123`
2. **Dashboard**: `/penyewa/dashboard` - Welcome page
3. **Booking**: `/penyewa/riwayat-booking` - Kelola booking
4. **Pembayaran**: `/penyewa/pembayaran` - Kirim bukti transfer
5. **Cari Kamar**: `/katalog` - Browse available rooms

---

## 🔐 Security Notes

✅ Session-based authentication
✅ Role filtering (hanya akses penyewa data sendiri)
✅ CSRF protection via form_open()
✅ Input sanitization dengan esc()
✅ Authorized access via filters

---

Created: 2025-11-25
Last Updated: 2025-11-25
