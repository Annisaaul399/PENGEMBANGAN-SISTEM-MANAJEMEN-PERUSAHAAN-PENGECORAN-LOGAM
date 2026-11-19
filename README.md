# CV KEMBAR JAYA ABADI Website

Website profil perusahaan dan sistem admin untuk CV KEMBAR JAYA ABADI, dengan fokus pada layanan pengecoran logam, turning, dan drilling.

## Fitur

- Halaman utama perusahaan
- Halaman About Us / Tentang Kami
- Halaman layanan:
  - Casting / Pengecoran
  - Turning / Bubut
  - Drilling / Pengeboran
- Galeri layanan dan dokumentasi
- Halaman pemesanan / order
- Panel admin untuk mengelola konten, layanan, galeri, dan pesanan
- Upload gambar untuk konten tertentu

## Teknologi

- PHP native
- MySQL / MariaDB
- PDO untuk koneksi database
- HTML, CSS, dan sedikit JavaScript

## Struktur Folder

- `index.php` - halaman utama website
- `tentangKami.php` - halaman tentang perusahaan
- `pengecoran.php`, `bubut.php`, `drilling.php` - halaman layanan
- `galeri.php` - halaman galeri
- `pemesanan.php` - halaman pemesanan
- `admin/` - panel admin
- `config/database.php` - konfigurasi koneksi database dan helper
- `kembar_jaya_db.sql` - file dump database
- `uploads/` - folder untuk file gambar yang diunggah

## Kebutuhan Sistem

- PHP 8.x atau lebih baru
- MySQL / MariaDB
- Web server seperti Apache (XAMPP, Laragon, WAMP, atau sejenisnya)

## Cara Menjalankan

1. Simpan project ke folder web server, misalnya `htdocs` jika memakai XAMPP.
2. Buat database baru dengan nama `kembar_jaya_db`.
3. Import file `kembar_jaya_db.sql` ke database tersebut.
4. Sesuaikan konfigurasi database di `config/database.php` jika username, password, atau host berbeda.
5. Pastikan folder `uploads/` memiliki izin tulis agar proses upload gambar berjalan.
6. Buka browser dan akses `index.php` melalui alamat lokal server Anda.

## Konfigurasi Database

File koneksi ada di `config/database.php`.

Default konfigurasi:

- Host: `localhost`
- Database: `kembar_jaya_db`
- Username: `root`
- Password: kosong

Jika Anda memakai environment lain, sesuaikan nilai tersebut dengan konfigurasi lokal Anda.

## Login Admin

Halaman login admin tersedia di `admin/login.php`.

Data admin disimpan di tabel `admin_users`. Jika ingin menambah akun admin baru, gunakan panel database atau buat query insert sesuai format password yang sudah di-hash.

## Catatan

- Beberapa folder seperti `frontend/` dan `MPTI/` berisi versi halaman statis/duplikasi untuk kebutuhan pengembangan atau backup.
- File gambar pada konten dan galeri diambil dari folder `uploads/` atau path gambar yang sudah tersimpan di database.

## Lisensi

Belum ditentukan.