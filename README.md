# 🚀 CodeLearn - Platform Edukasi Koding Interaktif

![Tangkapan Layar Dashboard Admin](https://i.imgur.com/lO5aLzB.png) 
*Catatan: Ganti URL di atas dengan tangkapan layar dashboard Anda yang sebenarnya.*

CodeLearn adalah sebuah platform edukasi berbasis web yang dirancang untuk membuat proses belajar koding menjadi lebih interaktif, terstruktur, dan menyenangkan. Proyek ini dibangun menggunakan Laravel sebagai backend dan dirancang untuk memenuhi kebutuhan Ujian Akhir Semester (UAS).

---

## ✨ Fitur Utama

Berdasarkan *Software Requirement Specification* (SRS), platform ini memiliki dua peran utama dengan fitur yang berbeda:

### 👤 Peran Admin
- **Dashboard Analitik**: Melihat ringkasan statistik platform.
- **Manajemen Tracks (CRUD)**: Membuat, membaca, memperbarui, dan menghapus jalur belajar (learning tracks).
- **Manajemen Materi (CRUD)**: Mengelola konten pembelajaran (artikel, video, PDF) di dalam setiap track.
- **Manajemen Kuis (CRUD)**: Membuat dan mengelola soal-soal kuis untuk setiap materi, termasuk pertanyaan dan jawaban.
- **Manajemen Pengguna**: Mengelola pengguna yang terdaftar di platform.

### 🎓 Peran Pengguna (User)
- **Akses Materi**: Mempelajari semua materi yang tersedia dalam format artikel, video, atau PDF.
- **Mengerjakan Kuis**: Menguji pemahaman melalui kuis pilihan ganda dan melihat skor secara langsung.
- **Diskusi**: Berinteraksi dengan pengguna lain melalui kolom komentar di setiap materi.

---

## 📈 Progres Pengembangan

Berikut adalah status pengembangan fitur-fitur utama platform hingga saat ini:

### Panel Admin
- [x] **Manajemen Tracks (CRUD)**: Fungsionalitas penuh untuk membuat, melihat, mengedit, dan menghapus tracks.
- [x] **Manajemen Materi (CRUD)**: Fungsionalitas penuh untuk mengelola materi (Artikel, Video, PDF), termasuk upload file.
- [x] **Manajemen Kuis (CRUD)**: Fungsionalitas penuh untuk mengelola kuis dan pertanyaan (tambah, edit, hapus) untuk setiap materi.
- [x] **Manajemen Pengguna**: Admin dapat melihat daftar pengguna dan menghapus pengguna dari sistem.
- [ ] **Dashboard Analitik**: Halaman sudah ada, namun perlu dihubungkan dengan data dinamis.

### Sisi Pengguna
- [ ] **Tampilan Learning Path & Materi**: Fitur selanjutnya yang akan dikerjakan.
- [ ] **Pengerjaan Kuis & Sistem Skor**: Belum dimulai.
- [ ] **Sistem Diskusi/Komentar**: Belum dimulai.

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Blade, Bootstrap 5 (untuk Panel Admin)
- **Database**: Sesuai konfigurasi (contoh menggunakan MySQL/PostgreSQL)
- **Development Tool**: Vite

---

## ⚙️ Instalasi & Setup Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone [URL_REPOSITORY_ANDA]
    cd code-learn
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
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1  
    DB_PORT=3306
    DB_DATABASE=codelearn
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Jalankan Migrasi & Seeder**
    Perintah ini akan membuat semua tabel dan mengisi data awal yang diperlukan.
    ```bash
    php artisan migrate --seed
    ```

7.  **Buat Symbolic Link untuk Storage**
    Penting agar file PDF yang di-upload bisa diakses.
    ```bash
    php artisan storage:link
    ```

8.  **Install Dependensi Node.js & Compile Aset**
    Pastikan Anda memiliki Node.js dan NPM terinstal.
    ```bash
    npm install
    npm run dev
    ```

9.  **Jalankan Server Development**
    Buka terminal baru dan jalankan server Laravel.
    ```bash
    php artisan serve
    ```

Sekarang, proyek Anda dapat diakses di `http://127.0.0.1:8000`.

---

## 📂 Struktur Folder Penting

-   `app/Http/Controllers/Admin/`
    > Semua logika untuk fitur-fitur di panel admin diletakkan di sini.

-   `app/Http/Controllers/`
    > Controller untuk pengguna umum (seperti `LearningController`) diletakkan di sini.

-   `app/Models/`
    > Tempat untuk semua model Eloquent (`User`, `Track`, `Material`, `Quiz`, `Question`, `Answer`).

-   `routes/web.php`
    > Semua rute untuk aplikasi web didefinisikan di sini, dipisahkan antara grup admin dan pengguna.

-   `resources/views/`
    -   `admin/`: Semua file view khusus untuk panel admin.
    -   `layouts/`: "Bingkai" atau template utama halaman (`admin.blade.php`, `app.blade.php`).
