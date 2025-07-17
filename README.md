 # 🚀 CodeLearn - Platform Edukasi Koding Interaktif

![Tangkapan Layar Dashboard Admin](https://i.imgur.com/lO5aLzB.png) 
*Catatan: Ganti URL di atas dengan tangkapan layar dashboard Anda yang sebenarnya.*

CodeLearn adalah sebuah platform edukasi berbasis web yang dirancang untuk membuat proses belajar koding menjadi lebih interaktif, terstruktur, dan menyenangkan. Proyek ini dibangun menggunakan Laravel sebagai backend dan dirancang untuk memenuhi kebutuhan Ujian Akhir Semester (UAS).

---

## ✨ Fitur Utama

Berdasarkan *Software Requirement Specification* (SRS), platform ini memiliki dua peran utama dengan fitur yang berbeda:

### 👤 Peran Admin
- **Dashboard Analitik**: Melihat ringkasan statistik platform seperti jumlah pengguna, tracks, materi, dan kuis dalam bentuk kartu dan grafik.
- **Manajemen Tracks (CRUD)**: Membuat, membaca, memperbarui, dan menghapus jalur belajar (learning tracks).
- **Manajemen Materi (CRUD)**: Mengelola konten pembelajaran (artikel, video, PDF) di dalam setiap track.
- **Manajemen Kuis (CRUD)**: Membuat dan mengelola soal-soal kuis untuk setiap materi.
- **Manajemen Pengguna**: Mengelola pengguna yang terdaftar di platform.

### 🎓 Peran Pengguna (User)
- **Dashboard Pengguna**: Melihat progres belajar, poin, dan peringkat.
- **Akses Materi**: Mempelajari semua materi yang tersedia dalam format artikel, video, atau PDF.
- **Mengerjakan Kuis**: Menguji pemahaman melalui kuis pilihan ganda dan melihat skor secara langsung.
- **Diskusi**: Berinteraksi dengan pengguna lain melalui kolom komentar di setiap materi.

---

## 📈 Progres Pengembangan

Berikut adalah status pengembangan fitur-fitur utama untuk Admin Panel:

- [x] **Dashboard Analitik**: Tampilan statistik dengan kartu dan grafik (menggunakan data dummy).
- [x] **Manajemen Tracks (CRUD)**: Fungsionalitas penuh untuk membuat, melihat, mengedit, dan menghapus tracks.
- [ ] **Manajemen Materi (CRUD)**: Fitur selanjutnya yang akan dikerjakan.
- [ ] **Manajemen Kuis (CRUD)**
- [ ] **Manajemen Pengguna**

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Blade, Bootstrap 5, CSS Kustom
- **JavaScript**: Chart.js untuk visualisasi data, jQuery
- **Database**: MySQL
- **Development Tool**: Vite

---

## ⚙️ Instalasi & Setup Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone [URL_REPOSITORY_ANDA]
    cd codelearn
    ```

2.  **Install Dependensi PHP**
    Pastikan Anda memiliki Composer terinstal.
    ```bash
    composer install
    ```

3.  **Buat File Environment**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database**
    Buka file `.env` dan sesuaikan konfigurasi database Anda.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=codelearn
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Jalankan Migrasi Database**
    Perintah ini akan membuat semua tabel yang diperlukan di database Anda.
    ```bash
    php artisan migrate
    ```

7.  **(Opsional) Jalankan Seeder**
    Jika Anda memiliki seeder untuk data awal (dummy data), jalankan perintah ini.
    ```bash
    php artisan db:seed
    ```

8.  **Install Dependensi Node.js**
    Pastikan Anda memiliki Node.js dan NPM terinstal.
    ```bash
    npm install
    ```

9.  **Compile Aset Frontend**
    Jalankan Vite untuk memantau perubahan pada file CSS/JS.
    ```bash
    npm run dev
    ```

10. **Jalankan Server Development**
    Buka terminal baru dan jalankan server Laravel.
    ```bash
    php artisan serve
    ```

Sekarang, proyek Anda dapat diakses di `http://127.0.0.1:8000`.

---

## 📂 Struktur Folder Penting (Untuk Tim)

Untuk memudahkan kolaborasi, berikut adalah penjelasan singkat mengenai di mana harus meletakkan file:

-   `app/Http/Controllers/Admin/`
    > Semua logika untuk fitur-fitur di panel admin (seperti `DashboardController`, `TrackController`) diletakkan di sini.

-   `app/Models/`
    > Tempat untuk semua model Eloquent yang merepresentasikan tabel di database (misalnya `User.php`, `Track.php`).

-   `routes/web.php`
    > Semua route untuk aplikasi web didefinisikan di sini. Kita menggunakan *grouping* untuk memisahkan route admin.

-   `resources/views/`
    -   `admin/`: Semua file view khusus untuk panel admin.
        -   `dashboard.blade.php`: Tampilan dashboard.
        -   `tracks/`: Folder untuk view CRUD tracks (`index`, `create`, `edit`).
    -   `layouts/`: "Bingkai" atau template utama halaman.
        -   `admin.blade.php`: Layout dasar untuk semua halaman admin.
    -   `partials/`: Potongan-potongan view yang bisa dipakai ulang.
        -   `admin-sidebar.blade.php`: Kode untuk sidebar admin.
        -   `admin-navbar.blade.php`: Kode untuk navbar admin.

-   `public/css/`
    > File CSS kustom seperti `modern-admin.css` diletakkan di sini.

---

## 👨‍💻 Kontributor

-   [Nama Anda] - Project Manager / Full-stack
-   [Nama Teman 1] - Backend Developer
-   [Nama Teman 2] - Frontend Developer

Terima kasih telah berkontribusi pada proyek CodeLearn!
