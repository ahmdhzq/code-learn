# 🚀 CodeLearn - Platform Edukasi Koding Interaktif

![Tangkapan Layar Dashboard Pengguna](https://github.com/ahmdhzq/code-learn/blob/main/public/assets/documentation/image.png?raw=true)

CodeLearn adalah sebuah platform edukasi berbasis web yang dirancang untuk membuat proses belajar koding menjadi lebih interaktif, terstruktur, dan menyenangkan. Proyek ini dibangun menggunakan Laravel 11 sebagai backend dengan fokus pada pengalaman pengguna yang dinamis dan panel admin yang komprehensif untuk pengelolaan konten.

---

## ✨ Fitur Utama

Platform ini memiliki dua peran utama dengan fitur yang berbeda:

### 👤 Peran Admin
- **Dashboard Analitik**: Melihat ringkasan statistik platform secara real-time.
- **Manajemen Learning Path (CRUD)**: Mengelola jalur belajar secara penuh.
- **Manajemen Materi (CRUD)**: Mengelola konten pembelajaran (artikel, video, PDF) dengan Rich Text Editor untuk artikel.
- **Manajemen Kuis (CRUD)**: Mengelola soal-soal kuis interaktif untuk setiap materi.
- **Manajemen Kontribusi**: Menyetujui atau menolak materi yang diajukan oleh pengguna berprestasi.
- **Manajemen Pengguna & Komentar**: Memoderasi interaksi pengguna di platform.

### 🎓 Peran Pengguna (User)
- **Halaman Depan & Practice**: Tampilan menarik untuk pengunjung dan halaman khusus untuk pengguna terdaftar melihat semua materi.
- **Dashboard Personal**: Melihat progres belajar dan jalur yang diikuti, serta akses ke fitur kontribusi.
- **Alur Belajar Berurutan**: Materi harus diselesaikan secara berurutan untuk membuka materi selanjutnya.
- **Pengerjaan Kuis**: Menguji pemahaman dengan sistem kuis interaktif dan melihat skor.
- **Sistem Poin & Peringkat**: Mendapatkan poin dari kuis untuk meningkatkan peringkat di leaderboard.
- **Fitur Kontribusi**: Pengguna dengan peringkat 5 teratas dapat mengajukan materi baru untuk di-review oleh admin.
- **Sistem Diskusi**: Berinteraksi melalui kolom komentar di setiap materi.

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Frontend**: Blade, Bootstrap 5, CKEditor (Rich Text Editor), Chart.js
- **Database**: PostgreSQL
- **Development Tool**: Vite

---

## 🔑 Akun Demo
Berikut adalah contoh akun yang bisa digunakan untuk demo, sesuai dengan data dari seeder:

| Peran | Email | Password | Catatan |
| :--- | :--- | :--- | :--- |
| 🧑‍💼 **Admin** | `admin@codelearn.com` | `password` | Memiliki akses penuh ke panel admin. |
| 🎓 **User** | `testing@gmail.com` | `password` | Pengguna biasa untuk mencoba alur belajar. |

---

## ⚙️ Instalasi & Setup Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda.

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/ahmdhzq/code-learn.git](https://github.com/ahmdhzq/code-learn.git)
    cd code-learn
    ```

2.  **Install Dependensi PHP & Node.js**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Migrasi & Seeding Database**
    Perintah ini akan membuat semua tabel dan mengisi data awal.
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Buat Symbolic Link untuk Storage**
    Penting agar file PDF dan gambar yang di-upload bisa diakses.
    ```bash
    php artisan storage:link
    ```

6.  **Jalankan Server & Vite**
    Buka dua terminal terpisah.
    ```bash
    # Di terminal 1
    php artisan serve

    # Di terminal 2
    npm run dev
    ```

Proyek Anda kini dapat diakses di `http://127.0.0.1:8000`.

---

## 👨‍💻 Tim Pengembang

| Nama | NIM |
| :--- | :--- |
| Ahmad Haziq Mu'izzaddin Wafiq | 230401010151 |
| Christ Dwi Marsono | 230401010144 |
| Revika Hendo Wiyogo | 230401010158 |