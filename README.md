# limelite-rental-camera
![image](https://github.com/muhammad-dicky/limelite-rental-camera/assets/58357765/43ca8b62-820c-4683-8ccb-c5a4c8ce97f3)

## Limelite Rental Kamera

Selamat datang di repositori Limelite Rental Kamera. Repositori ini adalah bagian dari proyek penyewaan kamera online yang dikembangkan dengan menggunakan CodeIgniter. Di bawah ini, Anda akan menemukan panduan untuk menginstal dan menjalankan proyek ini di lingkungan lokal Anda.

### Panduan Instalasi

Berikut langkah-langkah untuk menginstal proyek Limelite Rental Kamera di lingkungan lokal Anda:

**Langkah 1: Clone Repositori**

Clone repositori ini ke dalam direktori web server lokal Anda (misalnya, menggunakan XAMPP, WAMP, atau sejenisnya):

```
git clone https://github.com/username/reponame.git
```

**Langkah 2: Update Dependencies**

Pindah ke direktori proyek dan jalankan perintah berikut untuk mengupdate dependensi menggunakan Composer:

```
composer update
```

**Langkah 3: Konfigurasi Database**

- Buat database baru di MySQL.
- Salin file `application/config/database.php.example` menjadi `application/config/database.php`.
- Buka file `application/config/database.php` dan konfigurasikan pengaturan database sesuai dengan informasi database Anda (nama database, username, dan password).

**Langkah 4: Jalankan Migrasi Database**

Jalankan migrasi database untuk membuat tabel-tabel yang diperlukan:

```
php index.php migrate
```

**Langkah 5: Akses sebagai SuperAdmin atau Admin**

- Akses area admin di `http://localhost/(nama folder kalian)/admin/auth/login`.
- Gunakan akun SuperAdmin dengan email `superadmin@gmail.com` dan password `superadmin`.
- Atau gunakan akun Admin dengan email `administrator@gmail.com` dan password `administrator`.

**Langkah 6: Akses sebagai Customer Biasa dan Sudah Berlangganan Member**

- Akses area frontend di `http://localhost/(nama folder kalian)/auth/login`.
- Gunakan akun biasa dengan email `batistuta@gmail.com` dan password `asdfghjkl`.
- Atau gunakan akun Admin dengan email `userpremium@gmail.com` dan password `asdfghjkl`.

**Langkah 7: Gunakan Aplikasi**

Anda sekarang dapat mulai menggunakan aplikasi Limelite Rental Kamera untuk mengelola penyewaan kamera Anda atau menjelajahi berbagai produk kamera yang kami tawarkan.

Terima kasih telah menggunakan Limelite Rental Kamera! Jika Anda memiliki pertanyaan atau masalah, jangan ragu untuk menghubungi saya.
