<<<<<<< HEAD
#image
![image](https://user-images.githubusercontent.com/58357765/220363567-27e14dba-9e86-4403-871a-c44c7dc03bfb.png)
![image](https://user-images.githubusercontent.com/58357765/220363639-cda50c3c-2ec3-4494-9689-2b97261490bd.png)
![image](https://user-images.githubusercontent.com/58357765/220363678-e4870b2a-9e73-4ef5-b677-606f27343021.png)
![image](https://user-images.githubusercontent.com/58357765/220363723-b0e1b084-1dc2-43b5-9d25-ff4eb16365c1.png)
![image](https://user-images.githubusercontent.com/58357765/220363779-4046d54b-1bd4-40d9-adcb-18335e97bde2.png)
![image](https://user-images.githubusercontent.com/58357765/220363827-6c028b8f-e0f4-4495-a28d-461446466322.png)



<h2>Cara Login</h2>
<ol>
  <li>Backend: Sebagai SuperAdmin atau Admin:
    <ul>
      <li>Akses ke http://localhost/futsal/admin/auth/login</li>
      <li>Gunakan akun SuperAdmin dengan email superadmin@gmail.com dan password: superadmin, Admin: administrator@gmail.com dan password: administrator</li>
    </ul>
  </li>
</ol>

login
SUPERADMIN :
superadmin@gmail.com
superadmin

ADMIN :
administrator@gmail.com
administrator

MEMBER PREMIUM :
userpremium@gmail.com
asdfghjkl

CUSTOMER BIASA :
batistuta@gmail.com
asdfghjkl

userbiasa@gmail.com
userbiasa

-----------------------------------
<h2>Fitur</h2>
<ol>
  <li>Booking lapangan secara online</li>
  <li>Nominal Omset Harian, Bulanan, dan Tahunan</li>
  <li>Grafik/Statistik Omset Bulanan dalam 1 Tahun berjalan</li>
  <li>Total data pada modul album, foto, event, lapangan, kategori, kontak, slider dan customer</li>
  <li>Manajemen Transaksi (generate invoice berdasarkan tahun-bulan-tanggal yang akan reset setiap bulan secara otomatis)</li>
  <li>Manajemen Lapangan</li>
  <li>Manajemen Album dan Foto</li>
  <li>Manajemen Event</li>
  <li>Manajemen Kategori</li>
  <li>Manajemen Slider</li>
  <li>Manajemen Kontak</li>
  <li>Manajemen User dan Customer</li>
  <li>Profil Bisnis</li>
  <li>Set Nominal Diskon Member</li>
</ol>

<h2>Tools</h2>
<ol>
  <li>PHP 7 (7.4.3)</li>
  <li>IonAuth 2</li>
  <li>Codeigniter 3 (3.1.8)</li>
  <li>MySQL</li>
  <li>Bootstrap 3</li>
  <li>AdminLTE 2</li>
</ol>

<h2>Cara Pakai</h2>
<ol>
  <li>download/clone project ini ke pc/komputer/laptop</li>
  <li>Letakkan di folder htdocs</li>
  <li>Buat database baru di phpmyadmin atau database manager lainnya dengan nama futsal_1</li>
  <li>Import database yang ada di dalam folder db</li>
  <li>Buka terminal ke direktori project dan jalankan perintah composer update</li>
  <li>Akses ke http://localhost/futsal</li>
</ol>



<h2>Catatan</h2>
<ol>
  <li>Sistem membership dilakukan secara manual dengan cara Customer menghubungi SuperAdmin. Kemudian SuperAdmin akan mengganti Tipe User Customer tersebut di backend panel sebagai SuperAdmin.</li>
</ol>
=======
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
>>>>>>> 6b302e9503878a0b8cb9213201c08cbd4a89c61b
