<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // =================================================================
        // TRACK 1: DASAR PEMROGRAMAN PYTHON (5 Materi)
        // =================================================================
        $trackPython = Track::create([
            'name' => 'Dasar Pemrograman Python',
            'description' => 'Mulai perjalanan Anda di dunia pemrograman dengan mempelajari fundamental Python, salah satu bahasa paling populer di dunia.'
        ]);

        // Materi 1.1
        $m1_1 = Material::create(['track_id' => $trackPython->id, 'title' => 'Pengenalan Python & Instalasi', 'type' => 'video', 'content' => 'Kdgj-bL436c', 'order' => 1]);
        $q1_1 = Quiz::create(['material_id' => $m1_1->id, 'title' => 'Kuis Pengenalan Python']);
        $qq1_1 = Question::create(['quiz_id' => $q1_1->id, 'question_text' => 'Siapakah pembuat bahasa pemrograman Python?']);
        Answer::create(['question_id' => $qq1_1->id, 'answer_text' => 'Guido van Rossum', 'is_correct' => true]);
        Answer::create(['question_id' => $qq1_1->id, 'answer_text' => 'James Gosling', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_1->id, 'answer_text' => 'Bjarne Stroustrup', 'is_correct' => false]);

        // Materi 1.2
        $m1_2 = Material::create(['track_id' => $trackPython->id, 'title' => 'Variabel dan Tipe Data', 'type' => 'article', 'content' => '<h1>Variabel di Python</h1><p>Variabel adalah lokasi memori yang dicadangkan untuk menyimpan nilai-nilai.</p>', 'order' => 2]);
        $q1_2 = Quiz::create(['material_id' => $m1_2->id, 'title' => 'Kuis Variabel']);
        $qq1_2 = Question::create(['quiz_id' => $q1_2->id, 'question_text' => 'Tipe data untuk angka desimal seperti 3.14 adalah...']);
        Answer::create(['question_id' => $qq1_2->id, 'answer_text' => 'Float', 'is_correct' => true]);
        Answer::create(['question_id' => $qq1_2->id, 'answer_text' => 'Integer', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_2->id, 'answer_text' => 'String', 'is_correct' => false]);

        // Materi 1.3
        $m1_3 = Material::create(['track_id' => $trackPython->id, 'title' => 'Operator & Kondisional (if-else)', 'type' => 'article', 'content' => '<h1>Kondisional</h1><p>Statement if, elif, dan else digunakan untuk membuat keputusan dalam program.</p>', 'order' => 3]);
        $q1_3 = Quiz::create(['material_id' => $m1_3->id, 'title' => 'Kuis Kondisional']);
        $qq1_3 = Question::create(['quiz_id' => $q1_3->id, 'question_text' => 'Keyword untuk kondisi "jika tidak" adalah...']);
        Answer::create(['question_id' => $qq1_3->id, 'answer_text' => 'if', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_3->id, 'answer_text' => 'elif', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_3->id, 'answer_text' => 'else', 'is_correct' => true]);

        // Materi 1.4
        $m1_4 = Material::create(['track_id' => $trackPython->id, 'title' => 'Perulangan (For & While Loop)', 'type' => 'video', 'content' => 'u_i5-o-_b9s', 'order' => 4]);
        $q1_4 = Quiz::create(['material_id' => $m1_4->id, 'title' => 'Kuis Perulangan']);
        $qq1_4 = Question::create(['quiz_id' => $q1_4->id, 'question_text' => 'Loop yang paling cocok untuk iterasi berdasarkan urutan (sequence) adalah...']);
        Answer::create(['question_id' => $qq1_4->id, 'answer_text' => 'For Loop', 'is_correct' => true]);
        Answer::create(['question_id' => $qq1_4->id, 'answer_text' => 'While Loop', 'is_correct' => false]);
        Answer::create(['question_id' => $qq1_4->id, 'answer_text' => 'Do-While Loop', 'is_correct' => false]);
        
        // =================================================================
        // TRACK 2: WEB DEVELOPMENT DASAR (4 Materi)
        // =================================================================
        $trackWeb = Track::create(['name' => 'Web Development Dasar', 'description' => 'Membangun pondasi untuk menjadi web developer dengan menguasai HTML untuk struktur dan CSS untuk styling.']);
        
        // Materi 2.1
        $m2_1 = Material::create(['track_id' => $trackWeb->id, 'title' => 'Pengenalan HTML', 'type' => 'video', 'content' => 'NBZ9Ro6UKV8', 'order' => 1]);
        $q2_1 = Quiz::create(['material_id' => $m2_1->id, 'title' => 'Kuis HTML']);
        $qq2_1 = Question::create(['quiz_id' => $q2_1->id, 'question_text' => 'Kepanjangan dari HTML adalah...']);
        Answer::create(['question_id' => $qq2_1->id, 'answer_text' => 'HyperText Markup Language', 'is_correct' => true]);
        Answer::create(['question_id' => $qq2_1->id, 'answer_text' => 'Hyper Tool Multi Language', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_1->id, 'answer_text' => 'High-level Text Machine Language', 'is_correct' => false]);
        
        // Materi 2.2
        $m2_2 = Material::create(['track_id' => $trackWeb->id, 'title' => 'Pengenalan CSS', 'type' => 'video', 'content' => 'J0a6YcPAi-g', 'order' => 2]);
        $q2_2 = Quiz::create(['material_id' => $m2_2->id, 'title' => 'Kuis CSS']);
        $qq2_2 = Question::create(['quiz_id' => $q2_2->id, 'question_text' => 'CSS digunakan untuk...']);
        Answer::create(['question_id' => $qq2_2->id, 'answer_text' => 'Mengatur struktur halaman', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_2->id, 'answer_text' => 'Mengatur tampilan dan gaya halaman', 'is_correct' => true]);
        Answer::create(['question_id' => $qq2_2->id, 'answer_text' => 'Mengatur logika server', 'is_correct' => false]);
        
        // Materi 2.3
        $m2_3 = Material::create(['track_id' => $trackWeb->id, 'title' => 'CSS Box Model', 'type' => 'article', 'content' => '<h1>Box Model</h1><p>Setiap elemen HTML pada dasarnya adalah sebuah kotak yang terdiri dari: margin, border, padding, dan content.</p>', 'order' => 3]);
        $q2_3 = Quiz::create(['material_id' => $m2_3->id, 'title' => 'Kuis Box Model']);
        $qq2_3 = Question::create(['quiz_id' => $q2_3->id, 'question_text' => 'Bagian terluar dari Box Model adalah...']);
        Answer::create(['question_id' => $qq2_3->id, 'answer_text' => 'Padding', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_3->id, 'answer_text' => 'Border', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_3->id, 'answer_text' => 'Margin', 'is_correct' => true]);

        // Materi 2.4
        $m2_4 = Material::create(['track_id' => $trackWeb->id, 'title' => 'Layouting dengan Flexbox', 'type' => 'video', 'content' => '7hheP52d-yE', 'order' => 4]);
        $q2_4 = Quiz::create(['material_id' => $m2_4->id, 'title' => 'Kuis Flexbox']);
        $qq2_4 = Question::create(['quiz_id' => $q2_4->id, 'question_text' => 'Properti `display` untuk mengaktifkan flexbox adalah...']);
        Answer::create(['question_id' => $qq2_4->id, 'answer_text' => 'flex', 'is_correct' => true]);
        Answer::create(['question_id' => $qq2_4->id, 'answer_text' => 'block', 'is_correct' => false]);
        Answer::create(['question_id' => $qq2_4->id, 'answer_text' => 'grid', 'is_correct' => false]);

        // =================================================================
        // TRACK 3: LARAVEL UNTUK PEMULA (4 Materi)
        // =================================================================
        $trackLaravel = Track::create(['name' => 'Laravel untuk Pemula', 'description' => 'Membuat aplikasi web modern dengan framework PHP terpopuler di dunia, Laravel.']);

        // Materi 3.1
        $m3_1 = Material::create(['track_id' => $trackLaravel->id, 'title' => 'Instalasi & Konfigurasi Laravel 11', 'type' => 'video', 'content' => 'LWBV6fr8IPw', 'order' => 1]);
        $q3_1 = Quiz::create(['material_id' => $m3_1->id, 'title' => 'Kuis Instalasi Laravel']);
        $qq3_1 = Question::create(['quiz_id' => $q3_1->id, 'question_text' => 'Manajer dependensi yang digunakan untuk menginstal Laravel adalah...']);
        Answer::create(['question_id' => $qq3_1->id, 'answer_text' => 'Composer', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_1->id, 'answer_text' => 'NPM', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_1->id, 'answer_text' => 'Yarn', 'is_correct' => false]);
        
        // Materi 3.2
        $m3_2 = Material::create(['track_id' => $trackLaravel->id, 'title' => 'Routing Dasar', 'type' => 'article', 'content' => '<h1>Routing</h1><p>File `routes/web.php` adalah tempat Anda mendefinisikan semua rute untuk aplikasi web Anda.</p>', 'order' => 2]);
        $q3_2 = Quiz::create(['material_id' => $m3_2->id, 'title' => 'Kuis Routing']);
        $qq3_2 = Question::create(['quiz_id' => $q3_2->id, 'question_text' => 'File mana yang digunakan untuk rute web di Laravel?']);
        Answer::create(['question_id' => $qq3_2->id, 'answer_text' => 'routes/api.php', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_2->id, 'answer_text' => 'routes/web.php', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_2->id, 'answer_text' => 'routes/channels.php', 'is_correct' => false]);

        // Materi 3.3
        $m3_3 = Material::create(['track_id' => $trackLaravel->id, 'title' => 'Konsep MVC di Laravel', 'type' => 'video', 'content' => 'hImy-p5kM1o', 'order' => 3]);
        $q3_3 = Quiz::create(['material_id' => $m3_3->id, 'title' => 'Kuis MVC']);
        $qq3_3 = Question::create(['quiz_id' => $q3_3->id, 'question_text' => 'Kepanjangan dari MVC adalah...']);
        Answer::create(['question_id' => $qq3_3->id, 'answer_text' => 'Model-View-Controller', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_3->id, 'answer_text' => 'Module-View-Component', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_3->id, 'answer_text' => 'Media-Vector-Canvas', 'is_correct' => false]);

        // Materi 3.4
        $m3_4 = Material::create(['track_id' => $trackLaravel->id, 'title' => 'Blade Templating Engine', 'type' => 'article', 'content' => '<h1>Blade</h1><p>Blade adalah templating engine sederhana namun kuat yang disediakan oleh Laravel.</p>', 'order' => 4]);
        $q3_4 = Quiz::create(['material_id' => $m3_4->id, 'title' => 'Kuis Blade']);
        $qq3_4 = Question::create(['quiz_id' => $q3_4->id, 'question_text' => 'Sintaks untuk menampilkan variabel di Blade adalah...']);
        Answer::create(['question_id' => $qq3_4->id, 'answer_text' => '{{ $variabel }}', 'is_correct' => true]);
        Answer::create(['question_id' => $qq3_4->id, 'answer_text' => '<?php echo $variabel; ?>', 'is_correct' => false]);
        Answer::create(['question_id' => $qq3_4->id, 'answer_text' => '{$variabel}', 'is_correct' => false]);

        // =================================================================
        // TRACK 4: JAVASCRIPT ESENSIAL (4 Materi)
        // =================================================================
        $trackJS = Track::create(['name' => 'JavaScript Esensial', 'description' => 'Pelajari dasar-dasar JavaScript untuk membuat halaman web Anda menjadi lebih interaktif dan dinamis.']);

        // Materi 4.1
        $m4_1 = Material::create(['track_id' => $trackJS->id, 'title' => 'Pengenalan JavaScript', 'type' => 'video', 'content' => 'kXhfK21bA-s', 'order' => 1]);
        $q4_1 = Quiz::create(['material_id' => $m4_1->id, 'title' => 'Kuis JavaScript']);
        $qq4_1 = Question::create(['quiz_id' => $q4_1->id, 'question_text' => 'JavaScript adalah bahasa pemrograman yang berjalan di sisi...']);
        Answer::create(['question_id' => $qq4_1->id, 'answer_text' => 'Client (Browser)', 'is_correct' => true]);
        Answer::create(['question_id' => $qq4_1->id, 'answer_text' => 'Server', 'is_correct' => false]);
        Answer::create(['question_id' => $qq4_1->id, 'answer_text' => 'Database', 'is_correct' => false]);

        // Materi 4.2
        $m4_2 = Material::create(['track_id' => $trackJS->id, 'title' => 'DOM Manipulation Dasar', 'type' => 'article', 'content' => '<h1>DOM</h1><p>DOM (Document Object Model) adalah antarmuka yang memungkinkan script untuk membaca dan memanipulasi konten dokumen.</p>', 'order' => 2]);
        $q4_2 = Quiz::create(['material_id' => $m4_2->id, 'title' => 'Kuis DOM']);
        $qq4_2 = Question::create(['quiz_id' => $q4_2->id, 'question_text' => 'Metode untuk memilih elemen berdasarkan ID-nya adalah...']);
        Answer::create(['question_id' => $qq4_2->id, 'answer_text' => 'document.querySelector()', 'is_correct' => false]);
        Answer::create(['question_id' => $qq4_2->id, 'answer_text' => 'document.getElementById()', 'is_correct' => true]);
        Answer::create(['question_id' => $qq4_2->id, 'answer_text' => 'document.getElementsByClass()', 'is_correct' => false]);

        // Materi 4.3
        $m4_3 = Material::create(['track_id' => $trackJS->id, 'title' => 'Events di JavaScript', 'type' => 'video', 'content' => '3f_8-AKhdyw', 'order' => 3]);
        $q4_3 = Quiz::create(['material_id' => $m4_3->id, 'title' => 'Kuis Events']);
        $qq4_3 = Question::create(['quiz_id' => $q4_3->id, 'question_text' => 'Event yang terjadi saat pengguna mengklik sebuah elemen adalah...']);
        Answer::create(['question_id' => $qq4_3->id, 'answer_text' => 'onmouseover', 'is_correct' => false]);
        Answer::create(['question_id' => $qq4_3->id, 'answer_text' => 'onchange', 'is_correct' => false]);
        Answer::create(['question_id' => $qq4_3->id, 'answer_text' => 'onclick', 'is_correct' => true]);
        
        // =================================================================
        // TRACK 5: KONTROL VERSI DENGAN GIT (4 Materi)
        // =================================================================
        $trackGit = Track::create(['name' => 'Kontrol Versi dengan Git', 'description' => 'Manajemen kode secara profesional menggunakan Git. Pelajari cara berkolaborasi dan melacak perubahan kode.']);

        // Materi 5.1
        $m5_1 = Material::create(['track_id' => $trackGit->id, 'title' => 'Apa itu Git & Kenapa Penting?', 'type' => 'video', 'content' => '8o_m_h_Dl-I', 'order' => 1]);
        $q5_1 = Quiz::create(['material_id' => $m5_1->id, 'title' => 'Kuis Pengenalan Git']);
        $qq5_1 = Question::create(['quiz_id' => $q5_1->id, 'question_text' => 'Git adalah contoh dari...']);
        Answer::create(['question_id' => $qq5_1->id, 'answer_text' => 'Version Control System (VCS)', 'is_correct' => true]);
        Answer::create(['question_id' => $qq5_1->id, 'answer_text' => 'Text Editor', 'is_correct' => false]);
        Answer::create(['question_id' => $qq5_1->id, 'answer_text' => 'Database Management System', 'is_correct' => false]);

        // Materi 5.2
        $m5_2 = Material::create(['track_id' => $trackGit->id, 'title' => 'Perintah Dasar Git', 'type' => 'article', 'content' => '<h1>Perintah Dasar</h1><ul><li>git add</li><li>git commit</li><li>git push</li><li>git pull</li></ul>', 'order' => 2]);
        $q5_2 = Quiz::create(['material_id' => $m5_2->id, 'title' => 'Kuis Perintah Git']);
        $qq5_2 = Question::create(['quiz_id' => $q5_2->id, 'question_text' => 'Perintah untuk menyimpan perubahan ke repositori lokal adalah...']);
        Answer::create(['question_id' => $qq5_2->id, 'answer_text' => 'git add', 'is_correct' => false]);
        Answer::create(['question_id' => $qq5_2->id, 'answer_text' => 'git push', 'is_correct' => false]);
        Answer::create(['question_id' => $qq5_2->id, 'answer_text' => 'git commit', 'is_correct' => true]);

        // Materi 5.3
        $m5_3 = Material::create(['track_id' => $trackGit->id, 'title' => 'Konsep Branching', 'type' => 'video', 'content' => 'f5_s_bh-s_U', 'order' => 3]);
        $q5_3 = Quiz::create(['material_id' => $m5_3->id, 'title' => 'Kuis Branching']);
        $qq5_3 = Question::create(['quiz_id' => $q5_3->id, 'question_text' => 'Branch default yang dibuat saat memulai repositori Git adalah...']);
        Answer::create(['question_id' => $qq5_3->id, 'answer_text' => 'main/master', 'is_correct' => true]);
        Answer::create(['question_id' => $qq5_3->id, 'answer_text' => 'develop', 'is_correct' => false]);
        Answer::create(['question_id' => $qq5_3->id, 'answer_text' => 'production', 'is_correct' => false]);

        // Materi 5.4
        $m5_4 = Material::create(['track_id' => $trackGit->id, 'title' => 'Bekerja dengan GitHub', 'type' => 'article', 'content' => '<h1>GitHub</h1><p>GitHub adalah platform hosting untuk repositori Git yang memungkinkan kolaborasi tim.</p>', 'order' => 4]);
        $q5_4 = Quiz::create(['material_id' => $m5_4->id, 'title' => 'Kuis GitHub']);
        $qq5_4 = Question::create(['quiz_id' => $q5_4->id, 'question_text' => 'Fitur di GitHub untuk mengajukan perubahan kode agar direview disebut...']);
        Answer::create(['question_id' => $qq5_4->id, 'answer_text' => 'Pull Request', 'is_correct' => true]);
        Answer::create(['question_id' => $qq5_4->id, 'answer_text' => 'Commit', 'is_correct' => false]);
        Answer::create(['question_id' => $qq5_4->id, 'answer_text' => 'Merge', 'is_correct' => false]);
    }
}