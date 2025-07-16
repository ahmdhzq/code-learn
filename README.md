# CodeLearn - Platform Edukasi Koding Interaktif

CodeLearn adalah sebuah website edukasi yang dirancang untuk membuat belajar koding menjadi lebih interaktif dan menyenangkan. Platform ini menggunakan Laravel untuk backend dan PostgreSQL sebagai database.

## ✅ Fitur yang Sudah Selesai

Berikut adalah daftar fitur yang sudah berhasil diimplementasikan sejauh ini:

-   [x] **Konfigurasi Proyek & Database**
    -   [x] Proyek Laravel 11.
    -   [x] Opsi database PostgreSQL menggunakan Docker atau instalasi lokal.
-   [x] **Sistem Autentikasi & Peran**
    -   [x] Registrasi dan Login Pengguna (Laravel Breeze).
    -   [x] Sistem Peran untuk membedakan `user` dan `admin`.
    -   [x] Middleware untuk memproteksi rute khusus admin.
-   [x] **Panel Administrasi**
    -   [x] Halaman dashboard khusus untuk admin yang aman.
    -   [x] Logika pengalihan (redirect) otomatis setelah login sesuai peran.
    -   [x] Controller dan View dasar untuk panel admin.
-   [ ] **Manajemen Jalur Belajar (Learning Tracks)**
    -   [ ] CRUD (Create, Read, Update, Delete) untuk Tracks.
-   [ ] **Manajemen Materi Edukasi**
-   [ ] **Sistem Kuis**
-   [ ] **Sistem Komunitas (Komentar)**

## 📂 Struktur Proyek

Struktur folder utama proyek ini adalah sebagai berikut:

```
code-learn/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/            # Controller untuk autentikasi (dari Breeze)
│   │   │   └── Admin/           # Controller khusus untuk panel admin
│   │   │       ├── DashboardController.php
│   │   │       └── TrackController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       └── Track.php
├── bootstrap/
│   └── app.php                  # Tempat mendaftarkan middleware
├── config/
├── database/
│   └── migrations/              # File-file migrasi database
├── public/
├── resources/
│   └── views/
│       ├── auth/                # View untuk login, register, dll.
│       └── admin/               # View khusus untuk panel admin
│           ├── dashboard.blade.php
│           └── tracks/
├── routes/
│   ├── web.php                  # Definisi rute utama dan admin
│   └── auth.php                 # Rute autentikasi (dari Breeze)
├── tests/
├── docker-data/                 # Folder data database (diabaikan oleh Git)
├── .env                         # File konfigurasi lingkungan (SANGAT PENTING)
├── .gitignore                   # File yang diabaikan oleh Git
├── composer.json                # Dependensi PHP
├── docker-compose.yml           # Konfigurasi untuk menjalankan database Docker (Opsional)
└── package.json                 # Dependensi JavaScript/CSS
```

---

## 🚀 Cara Instalasi & Menjalankan Proyek

Panduan ini berlaku untuk **Windows, macOS, dan Linux**.

### Prasyarat

Pastikan perangkat lunak berikut sudah terinstal di komputer Anda:
1.  **Git**: Untuk mengunduh repositori.
2.  **PHP**: Versi 8.2 atau lebih baru.
3.  **Composer**: Manajer dependensi untuk PHP.
4.  **Node.js & NPM**: Untuk mengelola aset frontend (CSS, JS).
5.  **PostgreSQL** ATAU **Docker**: Anda hanya perlu salah satu untuk database.

### Langkah-langkah Instalasi

1.  **Clone Repositori**
    Buka terminal atau command prompt, navigasi ke direktori kerja Anda, dan jalankan:
    ```bash
    git clone [https://github.com/ahmdhzq/code-learn.git](https://github.com/ahmdhzq/code-learn.git)
    cd code-learn
    ```

2.  **Buat File Konfigurasi Lingkungan (`.env`)**
    Salin file contoh `.env.example` menjadi `.env`.
    ```bash
    # Untuk Linux/macOS
    cp .env.example .env

    # Untuk Windows
    copy .env.example .env
    ```

3.  **Instal Dependensi PHP**
    ```bash
    composer install
    ```

4.  **Generate Kunci Aplikasi**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database (Pilih Salah Satu Opsi)**
    Pilih salah satu cara untuk menyiapkan database Anda.

    ---
    #### **Opsi A: Menggunakan Docker (Direkomendasikan)**
    Cara ini paling mudah dan konsisten di semua sistem operasi.
    a. Pastikan Docker Desktop (Windows/macOS) atau service Docker (Linux) berjalan.
    b. Jalankan perintah ini dari folder proyek:
        ```bash
        docker-compose up -d
        ```
    c. Konfigurasi file `.env` Anda sebagai berikut:
        ```env
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=laravel_db
        DB_USERNAME=laravel_user
        DB_PASSWORD=secret_password
        ```
    ---
    #### **Opsi B: Menggunakan PostgreSQL Lokal (Tanpa Docker)**
    Gunakan cara ini jika Anda sudah menginstal PostgreSQL langsung di komputer Anda.
    a. Pastikan service PostgreSQL berjalan.
    b. Buat database baru (misalnya `codelearn_db`) dan user baru melalui pgAdmin atau baris perintah.
    c. Konfigurasi file `.env` Anda sesuai dengan detail database lokal Anda:
        ```env
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=nama_database_lokal_anda
        DB_USERNAME=user_database_lokal_anda
        DB_PASSWORD=password_database_lokal_anda
        ```
    ---

6.  **Jalankan Migrasi Database**
    Setelah database siap (baik dari Docker maupun lokal), jalankan perintah ini untuk membuat semua tabel:
    ```bash
    php artisan migrate
    ```

7.  **Instal Dependensi Frontend**
    ```bash
    npm install
    ```

8.  **Jalankan Server Pengembangan**
    Anda perlu menjalankan dua server secara bersamaan di dua terminal terpisah.

    * **Terminal 1 (Backend Laravel):**
        ```bash
        php artisan serve
        ```
        Aplikasi Anda akan berjalan di `http://127.0.0.1:8000`.

    * **Terminal 2 (Frontend Vite):**
        ```bash
        npm run dev
        ```
        Server ini akan mengkompilasi aset CSS dan JavaScript secara otomatis.

**Selesai!** Anda sekarang bisa membuka `http://127.0.0.1:8000` di browser Anda dan mulai mengembangkan.
