# Selamat Datang di Aplikasi Amalan Bulan Ramadhan

**Amalan Bulan Ramadhan** adalah aplikasi yang dirancang untuk membantu dalam pengelolaan kegiatan Ramadhan seperti pembuatan blangko kosong, jadwal, serta permohonan untuk kegiatan kultum, kulsub, dan pemberian takjil.

## ✨ Fitur Utama

- **Manajemen Takjil**: Penjadwalan pemberian takjil, termasuk untuk malam takbiran.
- **Pengelolaan Imam & Pembicara**: Penjadwalan imam, kultum, dan kulsub.
- **Pembuatan Catatan untuk Surat Lembar Permohonan**: Membuat lembar permohonan untuk kultum dan takjil.
- **Import Tanda Tangan & Cap**: Mempermudah administrasi dengan tanda tangan dan cap digital.

## ⚙️ Teknologi yang Digunakan

- **Framework**: Laravel 11
- **Bahasa Pemrograman**: PHP 8.2 (Thread Safe)
- **Dependency Management**: Node.js (NPM) & Composer
- **Database**: MySQL Community Edition

## 🔄 Alur Aplikasi

1. **Membuat Agenda**: Menentukan jadwal kultum dan takjil.
2. **Membuat Daftar Masjid**: Mengelola daftar masjid yang berpartisipasi.
3. **Menambahkan Ustadz**: Mengelola daftar ustadz dan pembicara.
4. **Menyusun Daftar Takjil**: Mengatur distribusi takjil.
5. **Menetapkan Imam & Pembicara**: Menentukan imam, pembicara kultum, dan kulsub.
6. **Ekspor PDF**:
   - Blangko kosong untuk jadwal takjil dan kultum.
   - Lembar permohonan untuk menjadi imam atau pembicara, dengan jadwal otomatis yang menandai nama ustadz.
   - Lembar permohonan untuk penyediaan makanan takjil.
   - Ekspor PDF berdasarkan filter tanggal, nama warga penerima takjil, atau nama ustadz.
   - Daftar ustadz dengan QR Code menuju lokasi masjid serta nomor telepon.

## 🚀 Panduan Instalasi & Penggunaan

1. **Setup Aplikasi**

   - Download zip pilih yang **Source Code (zip)**.
   - Ekstrak **AmalanRamadhan-1.0.0.zip**, jika tidak memiliki zip ekstraktor install **7z**.
   - Jalankan `setup-server-windows.bat`.
   - Jika terdapat error setelah `[10/10] Clearing App cache...`, silakan pencet tombol apapun untuk keluar, kemudian ulangi langkah nomor 3 lagi.
   - Well done.

2. **Menjalankan & Menghentikan Server**

   - Mulai server: `start-server-windows.bat`
   - Hentikan server: `stop-server-windows.bat`

3. **Akses Aplikasi**
   - Buka aplikasi melalui **port 1722**.
   - Kredensial default:
     - **Username**: `user`
     - **Password**: `password`

Selamat menggunakan aplikasi **Amalan Bulan Ramadhan**! Semoga bermanfaat dalam mendukung kegiatan ibadah di bulan suci ini. 🙏
