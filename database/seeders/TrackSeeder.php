<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Track;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;

class TrackSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Membuat data Learning Path, Materi, dan Kuis yang super lengkap...');

        // =================================================================
        // TRACK 1: WEB DEVELOPMENT FUNDAMENTALS (4 Materi)
        // =================================================================
        $trackWeb = Track::create([
            'name' => 'Web Development Fundamentals',
            'description' => 'Bangun pondasi kuat sebagai Web Developer dengan menguasai HTML, CSS, dan konsep dasar web.'
        ]);

        // Materi 1.1 (Artikel)
        $m1_1 = Material::create([
            'track_id' => $trackWeb->id, 'title' => 'Anatomi sebuah Halaman Web', 'type' => 'article',
            'content' => '<h2>Membedah Struktur Dasar HTML</h2><p>Setiap halaman web yang Anda lihat pada dasarnya adalah sebuah dokumen teks yang disusun menggunakan <strong>HyperText Markup Language (HTML)</strong>. Anggap saja HTML sebagai kerangka atau tulang dari sebuah bangunan.</p><h3>Blok Bangunan Utama:</h3><ul><li><code>&lt;!DOCTYPE html&gt;</code>: Deklarasi yang memberitahu browser bahwa ini adalah dokumen HTML5.</li><li><code>&lt;html&gt;</code>: Elemen root yang membungkus semua konten halaman.</li><li><code>&lt;head&gt;</code>: Berisi meta-informasi tentang halaman.</li><li><code>&lt;body&gt;</code>: Di sinilah semua konten yang terlihat oleh pengunjung berada.</li></ul>',
            'order' => 1, 'status' => 'approved'
        ]);
        $q1_1 = Quiz::create(['material_id' => $m1_1->id, 'title' => 'Kuis Struktur HTML']);
        $qq1_1 = Question::create(['quiz_id' => $q1_1->id, 'question_text' => 'Tag HTML manakah yang berisi konten yang terlihat oleh user?']);
        Answer::create(['question_id' => $qq1_1->id, 'answer_text' => '<body>', 'is_correct' => true]);
        Answer::create(['question_id' => $qq1_1->id, 'answer_text' => '<head>', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_1->id, 'answer_text' => '<title>', 'is_correct' => false]);

        // Materi 1.2 (Video)
        $m1_2 = Material::create(['track_id' => $trackWeb->id, 'title' => 'Styling dengan CSS', 'type' => 'video', 'content' => 'J0a6YcPAi-g', 'order' => 2, 'status' => 'approved']);
        $q1_2 = Quiz::create(['material_id' => $m1_2->id, 'title' => 'Kuis Dasar CSS']);
        $qq1_2 = Question::create(['quiz_id' => $q1_2->id, 'question_text' => 'Properti CSS mana yang digunakan untuk mengubah warna teks?']);
        Answer::create(['question_id' => $qq1_2->id, 'answer_text' => 'color', 'is_correct' => true]);
        Answer::create(['question_id' => $qq1_2->id, 'answer_text' => 'font-color', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_2->id, 'answer_text' => 'text-color', 'is_correct' => false]);


        // Materi 1.3 (Artikel)
        $m1_3 = Material::create([
            'track_id' => $trackWeb->id, 'title' => 'Memahami CSS Box Model', 'type' => 'article',
            'content' => '<h2>Konsep Kotak di CSS</h2><p>Di dunia CSS, setiap elemen HTML dianggap sebagai sebuah kotak persegi. "Box Model" terdiri dari empat bagian utama, dari dalam ke luar: Content, Padding, Border, dan Margin.</p>',
            'order' => 3, 'status' => 'approved'
        ]);
        $q1_3 = Quiz::create(['material_id' => $m1_3->id, 'title' => 'Kuis Box Model']);
        $qq1_3 = Question::create(['quiz_id' => $q1_3->id, 'question_text' => 'Bagian terluar dari Box Model adalah...']);
        Answer::create(['question_id' => $qq1_3->id, 'answer_text' => 'Margin', 'is_correct' => true]);
        Answer::create(['question_id' => $qq1_3->id, 'answer_text' => 'Padding', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_3->id, 'answer_text' => 'Border', 'is_correct' => false]);
        
        // Materi 1.4 (Video)
        $m1_4 = Material::create(['track_id' => $trackWeb->id, 'title' => 'Layouting Modern dengan Flexbox', 'type' => 'video', 'content' => '7hheP52d-yE', 'order' => 4, 'status' => 'approved']);
        $q1_4 = Quiz::create(['material_id' => $m1_4->id, 'title' => 'Kuis Flexbox']);
        $qq1_4 = Question::create(['quiz_id' => $q1_4->id, 'question_text' => 'Untuk mengaktifkan Flexbox, properti `display` harus diatur ke...']);
        Answer::create(['question_id' => $qq1_4->id, 'answer_text' => 'flex', 'is_correct' => true]);
        Answer::create(['question_id' => $qq1_4->id, 'answer_text' => 'block', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_4->id, 'answer_text' => 'inline', 'is_correct' => false]);


        // =================================================================
        // TRACK 2: PYTHON UNTUK PEMULA (4 Materi)
        // =================================================================
        $trackPython = Track::create([
            'name' => 'Python untuk Pemula',
            'description' => 'Mulai perjalanan Anda di dunia pemrograman dengan mempelajari fundamental Python, salah satu bahasa paling populer.'
        ]);

        // Materi 2.1 (Video)
        $m2_1 = Material::create(['track_id' => $trackPython->id, 'title' => 'Instalasi Python & Pengenalan Awal', 'type' => 'video', 'content' => 'Kdgj-bL436c', 'order' => 1, 'status' => 'approved']);
        $q2_1 = Quiz::create(['material_id' => $m2_1->id, 'title' => 'Kuis Pengenalan Python']);
        $qq2_1 = Question::create(['quiz_id' => $q2_1->id, 'question_text' => 'Siapakah pembuat bahasa pemrograman Python?']);
        Answer::create(['question_id' => $qq2_1->id, 'answer_text' => 'Guido van Rossum', 'is_correct' => true]);
        Answer::create(['question_id' => $qq2_1->id, 'answer_text' => 'James Gosling', 'is_correct' => false]);
        
        // Materi 2.2 (Artikel)
        $m2_2 = Material::create([
            'track_id' => $trackPython->id, 'title' => 'Variabel dan Tipe Data Dasar', 'type' => 'article',
            'content' => '<h2>Menyimpan Informasi dengan Variabel</h2><p>Tipe data umum di Python antara lain String (teks), Integer (bilangan bulat), Float (desimal), dan Boolean (True/False).</p>',
            'order' => 2, 'status' => 'approved'
        ]);
        $q2_2 = Quiz::create(['material_id' => $m2_2->id, 'title' => 'Kuis Tipe Data']);
        $qq2_2 = Question::create(['quiz_id' => $q2_2->id, 'question_text' => 'Tipe data untuk menyimpan teks seperti "Halo" adalah...']);
        Answer::create(['question_id' => $qq2_2->id, 'answer_text' => 'String', 'is_correct' => true]);
        Answer::create(['question_id' => $qq2_2->id, 'answer_text' => 'Integer', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_2->id, 'answer_text' => 'Boolean', 'is_correct' => false]);

        // Materi 2.3 (Artikel)
        $m2_3 = Material::create([
            'track_id' => $trackPython->id, 'title' => 'Struktur Kontrol: Logika If-Else', 'type' => 'article',
            'content' => '<h2>Membuat Keputusan dalam Kode</h2><p>Struktur `if`, `elif` (else if), dan `else` digunakan untuk membuat program melakukan aksi yang berbeda tergantung pada kondisi tertentu.</p>',
            'order' => 3, 'status' => 'approved'
        ]);
        $q2_3 = Quiz::create(['material_id' => $m2_3->id, 'title' => 'Kuis Kondisional']);
        $qq2_3 = Question::create(['quiz_id' => $q2_3->id, 'question_text' => 'Keyword untuk "else if" dalam Python adalah...']);
        Answer::create(['question_id' => $qq2_3->id, 'answer_text' => 'elif', 'is_correct' => true]);
        Answer::create(['question_id' => $qq2_3->id, 'answer_text' => 'else if', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_3->id, 'answer_text' => 'if else', 'is_correct' => false]);
        
        // Materi 2.4 (Video)
        $m2_4 = Material::create(['track_id' => $trackPython->id, 'title' => 'Perulangan dengan For & While Loop', 'type' => 'video', 'content' => 'u_i5-o-_b9s', 'order' => 4, 'status' => 'approved']);
        $q2_4 = Quiz::create(['material_id' => $m2_4->id, 'title' => 'Kuis Perulangan']);
        $qq2_4 = Question::create(['quiz_id' => $q2_4->id, 'question_text' => 'Loop yang digunakan untuk iterasi pada sebuah list adalah...']);
        Answer::create(['question_id' => $qq2_4->id, 'answer_text' => 'For loop', 'is_correct' => true]);
        Answer::create(['question_id' => $qq2_4->id, 'answer_text' => 'While loop', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_4->id, 'answer_text' => 'If loop', 'is_correct' => false]);

        // =================================================================
        // TRACK 3: DASAR-DASAR GIT & GITHUB (4 Materi)
        // =================================================================
        $trackGit = Track::create([
            'name' => 'Dasar-dasar Git & GitHub',
            'description' => 'Pelajari cara mengelola versi kode Anda secara profesional dan berkolaborasi dengan tim menggunakan Git dan GitHub.'
        ]);

        // Materi 3.1 (Artikel)
        $m3_1 = Material::create([
            'track_id' => $trackGit->id, 'title' => 'Apa itu Version Control System?', 'type' => 'article',
            'content' => '<h2>Melacak Setiap Perubahan</h2><p><strong>Version Control System (VCS)</strong> adalah sistem yang mencatat setiap perubahan pada file dari waktu ke waktu sehingga Anda dapat kembali ke versi tertentu di masa depan. <strong>Git</strong> adalah VCS modern yang paling populer.</p>',
            'order' => 1, 'status' => 'approved'
        ]);
        $q3_1 = Quiz::create(['material_id' => $m3_1->id, 'title' => 'Kuis Konsep VCS']);
        $qq3_1 = Question::create(['quiz_id' => $q3_1->id, 'question_text' => 'Apa kepanjangan dari VCS?']);
        Answer::create(['question_id' => $qq3_1->id, 'answer_text' => 'Version Control System', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_1->id, 'answer_text' => 'Virtual Code System', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_1->id, 'answer_text' => 'Version Coding Standard', 'is_correct' => false]);

        // Materi 3.2 (Video)
        $m3_2 = Material::create(['track_id' => $trackGit->id, 'title' => 'Perintah Dasar Git yang Wajib Diketahui', 'type' => 'video', 'content' => '8o_m_h_Dl-I', 'order' => 2, 'status' => 'approved']);
        $q3_2 = Quiz::create(['material_id' => $m3_2->id, 'title' => 'Kuis Perintah Git']);
        $qq3_2 = Question::create(['quiz_id' => $q3_2->id, 'question_text' => 'Perintah untuk menyimpan perubahan ke repositori lokal adalah...']);
        Answer::create(['question_id' => $qq3_2->id, 'answer_text' => 'git commit', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_2->id, 'answer_text' => 'git push', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_2->id, 'answer_text' => 'git add', 'is_correct' => false]);

        // Materi 3.3 (Artikel)
        $m3_3 = Material::create([
            'track_id' => $trackGit->id, 'title' => 'Konsep Branching (Percabangan)', 'type' => 'article',
            'content' => '<h2>Bekerja Tanpa Mengganggu</h2><p><em>Branching</em> adalah fitur Git untuk membuat "cabang" pengembangan terpisah. Anda bisa mengerjakan fitur baru di branch Anda tanpa mengganggu branch utama (`main`).</p>',
            'order' => 3, 'status' => 'approved'
        ]);
        $q3_3 = Quiz::create(['material_id' => $m3_3->id, 'title' => 'Kuis Branching']);
        $qq3_3 = Question::create(['quiz_id' => $q3_3->id, 'question_text' => 'Apa nama branch default di Git?']);
        Answer::create(['question_id' => $qq3_3->id, 'answer_text' => 'main atau master', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_3->id, 'answer_text' => 'develop', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_3->id, 'answer_text' => 'feature', 'is_correct' => false]);

        // Materi 3.4 (Video)
        $m3_4 = Material::create(['track_id' => $trackGit->id, 'title' => 'Kolaborasi dengan GitHub', 'type' => 'video', 'content' => 'f5_s_bh-s_U', 'order' => 4, 'status' => 'approved']);
        $q3_4 = Quiz::create(['material_id' => $m3_4->id, 'title' => 'Kuis GitHub']);
        $qq3_4 = Question::create(['quiz_id' => $q3_4->id, 'question_text' => 'Fitur di GitHub untuk mengajukan penggabungan kode disebut...']);
        Answer::create(['question_id' => $qq3_4->id, 'answer_text' => 'Pull Request', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_4->id, 'answer_text' => 'Merge Request', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_4->id, 'answer_text' => 'Push Request', 'is_correct' => false]);

        // =================================================================
        // TRACK 4: LARAVEL KILAT (4 Materi)
        // =================================================================
        $trackLaravel = Track::create([
            'name' => 'Laravel Kilat',
            'description' => 'Membangun aplikasi web fungsional dengan cepat menggunakan framework PHP paling elegan, Laravel.'
        ]);

        // Materi 4.1 (Artikel)
        $m4_1 = Material::create([
            'track_id' => $trackLaravel->id, 'title' => 'Memahami Konsep MVC', 'type' => 'article',
            'content' => '<h2>Pola Arsitektur MVC</h2><p>Laravel menggunakan pola arsitektur <strong>Model-View-Controller (MVC)</strong> untuk memisahkan logika aplikasi menjadi tiga bagian: Model (data), View (tampilan), dan Controller (jembatan).</p>',
            'order' => 1, 'status' => 'approved'
        ]);
        $q4_1 = Quiz::create(['material_id' => $m4_1->id, 'title' => 'Kuis Konsep MVC']);
        $qq4_1 = Question::create(['quiz_id' => $q4_1->id, 'question_text' => 'Bagian mana dari MVC yang berinteraksi dengan database?']);
        Answer::create(['question_id' => $qq4_1->id, 'answer_text' => 'Model', 'is_correct' => true]);
        Answer::create(['question_id' => $qq4_1->id, 'answer_text' => 'View', 'is_correct' => false]);
        Answer::create(['question_id' => $qq4_1->id, 'answer_text' => 'Controller', 'is_correct' => false]);

        // Materi 4.2 (Video)
        $m4_2 = Material::create(['track_id' => $trackLaravel->id, 'title' => 'Routing dan Controller Dasar', 'type' => 'video', 'content' => 'LWBV6fr8IPw', 'order' => 2, 'status' => 'approved']);
        $q4_2 = Quiz::create(['material_id' => $m4_2->id, 'title' => 'Kuis Routing Laravel']);
        $qq4_2 = Question::create(['quiz_id' => $q4_2->id, 'question_text' => 'Di file mana rute untuk web biasanya didefinisikan?']);
        Answer::create(['question_id' => $qq4_2->id, 'answer_text' => 'routes/web.php', 'is_correct' => true]);
        Answer::create(['question_id' => $qq4_2->id, 'answer_text' => 'routes/api.php', 'is_correct' => false]);

        // Materi 4.3 (Artikel)
        $m4_3 = Material::create([
            'track_id' => $trackLaravel->id, 'title' => 'Mengenal Blade Templating Engine', 'type' => 'article',
            'content' => '<h2>Menulis HTML dengan Kekuatan Super</h2><p>Blade adalah <em>templating engine</em> bawaan Laravel yang membuat penulisan View menjadi sangat mudah. Anda bisa menggunakan sintaks seperti <code>@if</code>, <code>@foreach</code>, dan <code>{{-- $variabel --}}</code>.</p>',
            'order' => 3, 'status' => 'approved'
        ]);
        $q4_3 = Quiz::create(['material_id' => $m4_3->id, 'title' => 'Kuis Blade']);
        $qq4_3 = Question::create(['quiz_id' => $q4_3->id, 'question_text' => 'Sintaks Blade untuk menampilkan variabel adalah...']);
        Answer::create(['question_id' => $qq4_3->id, 'answer_text' => '{{ $namaVariabel }}', 'is_correct' => true]);
        Answer::create(['question_id' => $qq4_3->id, 'answer_text' => '<?php echo $namaVariabel; ?>', 'is_correct' => false]);

        // Materi 4.4 (Video)
        $m4_4 = Material::create(['track_id' => $trackLaravel->id, 'title' => 'Pengenalan Eloquent ORM', 'type' => 'video', 'content' => 'hImy-p5kM1o', 'order' => 4, 'status' => 'approved']);
        $q4_4 = Quiz::create(['material_id' => $m4_4->id, 'title' => 'Kuis Eloquent']);
        $qq4_4 = Question::create(['quiz_id' => $q4_4->id, 'question_text' => 'Eloquent di Laravel adalah sebuah...']);
        Answer::create(['question_id' => $qq4_4->id, 'answer_text' => 'Object-Relational Mapper (ORM)', 'is_correct' => true]);
        Answer::create(['question_id' => $qq4_4->id, 'answer_text' => 'Templating Engine', 'is_correct' => false]);
        Answer::create(['question_id' => $qq4_4->id, 'answer_text' => 'Routing System', 'is_correct' => false]);

        // =================================================================
        // TRACK 5: JAVASCRIPT INTERAKTIF (4 Materi)
        // =================================================================
        $trackJS = Track::create([
            'name' => 'JavaScript Interaktif',
            'description' => 'Hidupkan halaman web Anda dengan mempelajari dasar-dasar JavaScript untuk memanipulasi DOM dan menangani event.'
        ]);

        // Materi 5.1 (Artikel)
        $m5_1 = Material::create([
            'track_id' => $trackJS->id, 'title' => 'Pengenalan Document Object Model (DOM)', 'type' => 'article',
            'content' => '<h2>Apa itu DOM?</h2><p>Saat browser memuat sebuah halaman web, ia membuat sebuah representasi dari dokumen HTML tersebut dalam bentuk struktur pohon. Struktur ini disebut <strong>Document Object Model (DOM)</strong>. JavaScript dapat berinteraksi dengan DOM ini untuk mengubah segala sesuatu di halaman.</p>',
            'order' => 1, 'status' => 'approved'
        ]);
        $q5_1 = Quiz::create(['material_id' => $m5_1->id, 'title' => 'Kuis Konsep DOM']);
        $qq5_1 = Question::create(['quiz_id' => $q5_1->id, 'question_text' => 'Apa kepanjangan dari DOM?']);
        Answer::create(['question_id' => $qq5_1->id, 'answer_text' => 'Document Object Model', 'is_correct' => true]);
        Answer::create(['question_id' => $qq5_1->id, 'answer_text' => 'Data Object Model', 'is_correct' => false]);
        
        // Materi 5.2 (Video)
        $m5_2 = Material::create(['track_id' => $trackJS->id, 'title' => 'Memilih Elemen DOM', 'type' => 'video', 'content' => 'kXhfK21bA-s', 'order' => 2, 'status' => 'approved']);
        $q5_2 = Quiz::create(['material_id' => $m5_2->id, 'title' => 'Kuis Selektor DOM']);
        $qq5_2 = Question::create(['quiz_id' => $q5_2->id, 'question_text' => 'Metode untuk memilih elemen berdasarkan ID-nya adalah...']);
        Answer::create(['question_id' => $qq5_2->id, 'answer_text' => 'document.getElementById()', 'is_correct' => true]);
        Answer::create(['question_id' => $qq5_2->id, 'answer_text' => 'document.querySelector()', 'is_correct' => false]);
        
        // Materi 5.3 (Artikel)
        $m5_3 = Material::create([
            'track_id' => $trackJS->id, 'title' => 'Menangani Aksi Pengguna (Events)', 'type' => 'article',
            'content' => '<h2>Membuat Halaman Merespon</h2><p><em>Events</em> adalah aksi yang terjadi di halaman web, seperti klik mouse atau input keyboard. JavaScript memungkinkan kita untuk "mendengarkan" event ini dan menjalankan kode sebagai respon menggunakan <code>addEventListener</code>.</p>',
            'order' => 3, 'status' => 'approved'
        ]);
        $q5_3 = Quiz::create(['material_id' => $m5_3->id, 'title' => 'Kuis JavaScript Events']);
        $qq5_3 = Question::create(['quiz_id' => $q5_3->id, 'question_text' => 'Method untuk "mendengarkan" sebuah event adalah...']);
        Answer::create(['question_id' => $qq5_3->id, 'answer_text' => 'addEventListener', 'is_correct' => true]);
        Answer::create(['question_id' => $qq5_3->id, 'answer_text' => 'onClick', 'is_correct' => false]);

        // Materi 5.4 (Video)
        $m5_4 = Material::create(['track_id' => $trackJS->id, 'title' => 'Mengambil Data dari API (Fetch)', 'type' => 'video', 'content' => '3f_8-AKhdyw', 'order' => 4, 'status' => 'approved']);
        $q5_4 = Quiz::create(['material_id' => $m5_4->id, 'title' => 'Kuis Fetch API']);
        $qq5_4 = Question::create(['quiz_id' => $q5_4->id, 'question_text' => 'Fungsi modern di JavaScript untuk membuat request ke jaringan (API) adalah...']);
        Answer::create(['question_id' => $qq5_4->id, 'answer_text' => 'Fetch API', 'is_correct' => true]);
        Answer::create(['question_id' => $qq5_4->id, 'answer_text' => 'jQuery.ajax()', 'is_correct' => false]);

        $this->command->info('Seeding data yang super lengkap selesai.');
    }
}