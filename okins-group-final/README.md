# OKINS GROUP — Company Profile Final Starter

Company profile bilingual (Indonesia/English), responsive, dengan admin dashboard dan Laravel API.

## Struktur

- `frontend/`: website publik dan halaman admin. Deploy folder ini ke Netlify.
- `backend/`: source code yang ditempelkan ke project Laravel baru dan di-host pada hosting PHP.
- `netlify.toml`: konfigurasi publish Netlify.

## Fitur

- Beranda, profil, visi, misi, nilai perusahaan, lini divisi, kontak.
- Pilihan bahasa Indonesia / English.
- Formulir kontak yang menyimpan pesan ke database Laravel.
- Dashboard admin: login, ubah profil, tambah/hapus misi, tambah/hapus divisi, baca pesan masuk.
- Token admin memiliki masa berlaku 8 jam dan disimpan sebagai hash di database.
- Validasi input dan rate limit pada login serta formulir kontak.

## PENTING: Netlify tidak menjalankan Laravel/PHP

Frontend dipublikasikan di Netlify. Backend Laravel wajib di-host di server PHP terpisah yang mendukung Composer dan MySQL/MariaDB. Project belum bisa live sebelum kedua deployment dan konfigurasi URL/domain dilakukan.

## A. Siapkan backend Laravel

1. Pada komputer, pastikan PHP, Composer, dan MySQL tersedia.
2. Buat project Laravel baru:

   ```bash
   composer create-project laravel/laravel okins-api
   cd okins-api
   ```

3. Pastikan API routing tersedia. Pada Laravel versi baru, jalankan `php artisan install:api` bila `routes/api.php` belum terdaftar.
4. Salin isi folder `backend/` dari paket ini ke project `okins-api/`, gabungkan folder `app`, `routes`, `database`, dan `config`.
5. Salin `backend/.env.example` sebagai panduan untuk mengisi `.env` Laravel. Buat database MySQL/MariaDB dan isi DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD.
6. Isi APP_KEY dengan hasil `php artisan key:generate`.
7. Isi `OKINS_ADMIN_PASSWORD` dengan password acak yang panjang dan unik. Jangan gunakan password contoh atau membagikan file `.env`.
8. Isi `FRONTEND_URL` dengan domain Netlify yang akan dipakai.
9. Jalankan:

   ```bash
   php artisan migrate
   php artisan db:seed --class=OkinsInitialSeeder
   php artisan config:clear
   php artisan route:list --path=api
   ```

   Pastikan `OkinsInitialSeeder` menggunakan namespace `Database\Seeders`; jika autoload belum mengenali kelas, jalankan `composer dump-autoload`.

10. Deploy seluruh project Laravel ke hosting PHP. Arahkan document root domain API ke folder `public/`. Jangan menaruh `.env` di folder publik.
11. Aktifkan HTTPS. Catat base URL API, misalnya `https://api.domainanda.com/api`.

### Endpoint API

- `GET /api/public-content` — data profil, misi, dan divisi untuk website.
- `POST /api/contact` — menyimpan pesan kontak.
- `POST /api/admin/login` — login admin.
- `GET /api/admin/dashboard` — data dashboard.
- `PUT /api/admin/profile` — memperbarui profil.
- `POST/DELETE /api/admin/missions` — tambah/hapus misi.
- `POST/DELETE /api/admin/divisions` — tambah/hapus divisi.
- `POST /api/admin/logout` — mengakhiri token.

## B. Hubungkan frontend dengan API

Edit `frontend/assets/js/config.js`:

```js
window.OKINS_CONFIG = {
  API_BASE_URL: "https://api.domainanda.com/api"
};
```

Jangan sisakan `YOUR-LARAVEL-API-DOMAIN`. Pastikan `FRONTEND_URL` di backend sama persis dengan domain Netlify. Setelah mengubah CORS, jalankan `php artisan config:clear`.

## C. Deploy ke Netlify

1. Ekstrak ZIP.
2. Unggah project ke repository GitHub.
3. Di Netlify pilih **Add new site → Import an existing project**.
4. Pilih repository.
5. Atur **Base directory**: `frontend`.
6. **Build command**: kosongkan.
7. **Publish directory**: `.`.
8. Deploy.
9. Salin domain Netlify, lalu masukkan ke `FRONTEND_URL` di backend Laravel. Pastikan URL tersebut juga diizinkan di `backend/config/cors.php`.
10. Jika URL frontend berubah, sesuaikan CORS dan deploy ulang backend.

Alternatif: drag-and-drop folder `frontend/` ke Netlify Drop untuk preview statis. API tetap belum aktif sampai backend di-host.

## D. Masuk dashboard

Buka `https://DOMAIN-NETLIFY-ANDA/admin.html` lalu login menggunakan email dan password admin dari environment backend. Jangan pernah memasukkan kredensial admin ke JavaScript atau repository publik.

## E. Sebelum website diumumkan

- Ganti alamat, nomor telepon, dan email contoh dengan data resmi.
- Pastikan logo dan foto yang digunakan sesuai hak penggunaan perusahaan.
- Tambahkan kebijakan privasi dan persetujuan pemrosesan data formulir kontak.
- Gunakan HTTPS pada frontend dan backend.
- Atur backup database, pantau log, dan perbarui Laravel/dependensi secara berkala.
- Tambahkan CAPTCHA/anti-spam bila formulir mulai menerima banyak trafik.
- Ganti password admin awal setelah login pertama.
- Uji login, CRUD, pengiriman formulir, bahasa, tampilan mobile, dan CORS pada domain produksi.

## Catatan kualitas dan batasan

Paket ini adalah source project siap dikonfigurasi dan dideploy, bukan website yang sudah dipublikasikan. Kami tidak dapat menerbitkan ke akun Netlify/hosting Anda tanpa akses dan tindakan dari pemilik akun. Tailwind CDN dipakai untuk kemudahan starter; untuk produksi skala besar, pindahkan ke Tailwind CLI/Vite agar CSS dapat dioptimalkan dan versi dependensi dikunci.
