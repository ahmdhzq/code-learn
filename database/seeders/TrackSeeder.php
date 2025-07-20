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
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // =================================================================
        // TRACK 1: DASAR PEMROGRAMAN PYTHON
        // =================================================================
        $trackPython = Track::create([
            'name' => 'Dasar Pemrograman Python',
            'description' => 'Mulai perjalanan Anda di dunia pemrograman dengan mempelajari fundamental Python, salah satu bahasa paling populer di dunia.'
        ]);

        // Materi 1.1: Pengenalan Python (Video)
        $materialPython1 = Material::create([
            'track_id' => $trackPython->id,
            'title' => 'Pengenalan Python & Instalasi',
            'type' => 'video',
            'content' => 'Kdgj-bL436c', // ID Video YouTube dari Kelas Terbuka
            'order' => 1,
        ]);
        $quizPython1 = Quiz::create(['material_id' => $materialPython1->id, 'title' => 'Kuis Pengenalan Python']);
        $questionPy1 = Question::create(['quiz_id' => $quizPython1->id, 'question_text' => 'Siapakah pembuat bahasa pemrograman Python?']);
        Answer::create(['question_id' => $questionPy1->id, 'answer_text' => 'Guido van Rossum', 'is_correct' => true]);
        Answer::create(['question_id' => $questionPy1->id, 'answer_text' => 'James Gosling', 'is_correct' => false]);
        Answer::create(['question_id' => $questionPy1->id, 'answer_text' => 'Bjarne Stroustrup', 'is_correct' => false]);

        // Materi 1.2: Variabel dan Tipe Data (Artikel)
        $materialPython2 = Material::create([
            'track_id' => $trackPython->id,
            'title' => 'Variabel dan Tipe Data',
            'type' => 'article',
            'content' => '<h1>Variabel di Python</h1><p>Variabel adalah lokasi memori yang dicadangkan untuk menyimpan nilai-nilai. Ini berarti bahwa ketika Anda membuat sebuah variabel, Anda memesan beberapa ruang di memori.</p><h2>Tipe Data Umum:</h2><ul><li>Integer</li><li>Float</li><li>String</li><li>Boolean</li></ul>',
            'order' => 2,
        ]);
        $quizPython2 = Quiz::create(['material_id' => $materialPython2->id, 'title' => 'Kuis Variabel']);
        $questionPy2 = Question::create(['quiz_id' => $quizPython2->id, 'question_text' => 'Tipe data untuk angka desimal seperti 3.14 adalah...']);
        Answer::create(['question_id' => $questionPy2->id, 'answer_text' => 'Integer', 'is_correct' => false]);
        Answer::create(['question_id' => $questionPy2->id, 'answer_text' => 'String', 'is_correct' => false]);
        Answer::create(['question_id' => $questionPy2->id, 'answer_text' => 'Float', 'is_correct' => true]);

        // =================================================================
        // TRACK 2: BELAJAR HTML & CSS
        // =================================================================
        $trackWeb = Track::create([
            'name' => 'Belajar HTML & CSS',
            'description' => 'Membangun pondasi untuk menjadi seorang web developer dengan menguasai HTML untuk struktur dan CSS untuk styling.'
        ]);

        // Materi 2.1: Pengenalan HTML (Video)
        $materialWeb1 = Material::create([
            'track_id' => $trackWeb->id,
            'title' => 'Pengenalan HTML untuk Pemula',
            'type' => 'video',
            'content' => 'NBZ9Ro6UKV8', // ID Video YouTube dari Web Programming UNPAS
            'order' => 1,
        ]);
        $quizWeb1 = Quiz::create(['material_id' => $materialWeb1->id, 'title' => 'Kuis Pengenalan HTML']);
        $questionWeb1 = Question::create(['quiz_id' => $quizWeb1->id, 'question_text' => 'Kepanjangan dari HTML adalah...']);
        Answer::create(['question_id' => $questionWeb1->id, 'answer_text' => 'HyperText Markup Language', 'is_correct' => true]);
        Answer::create(['question_id' => $questionWeb1->id, 'answer_text' => 'Hyper Tool Multi Language', 'is_correct' => false]);
        Answer::create(['question_id' => $questionWeb1->id, 'answer_text' => 'High-level Text Machine Language', 'is_correct' => false]);

        // Materi 2.2: Struktur Dasar Halaman HTML (Artikel)
        $materialWeb2 = Material::create([
            'track_id' => $trackWeb->id,
            'title' => 'Struktur Dasar Halaman HTML',
            'type' => 'article',
            'content' => '<h1>Struktur Dasar</h1><p>Setiap dokumen HTML memiliki struktur dasar yang terdiri dari tag &lt;!DOCTYPE html&gt;, &lt;html&gt;, &lt;head&gt;, dan &lt;body&gt;.</p>',
            'order' => 2,
        ]);
        $quizWeb2 = Quiz::create(['material_id' => $materialWeb2->id, 'title' => 'Kuis Struktur HTML']);
        $questionWeb2 = Question::create(['quiz_id' => $quizWeb2->id, 'question_text' => 'Tag mana yang digunakan untuk mendefinisikan konten utama halaman web?']);
        Answer::create(['question_id' => $questionWeb2->id, 'answer_text' => '<body>', 'is_correct' => true]);
        Answer::create(['question_id' => $questionWeb2->id, 'answer_text' => '<head>', 'is_correct' => false]);
        Answer::create(['question_id' => $questionWeb2->id, 'answer_text' => '<title>', 'is_correct' => false]);

        // =================================================================
        // TRACK 3: LARAVEL UNTUK PEMULA
        // =================================================================
        $trackLaravel = Track::create([
            'name' => 'Laravel untuk Pemula',
            'description' => 'Membuat aplikasi web modern dengan framework PHP terpopuler di dunia, Laravel.'
        ]);

        // Materi 3.1: Instalasi Laravel 11 (Video)
        $materialLaravel1 = Material::create([
            'track_id' => $trackLaravel->id,
            'title' => 'Instalasi & Konfigurasi Laravel 11',
            'type' => 'video',
            'content' => 'LWBV6fr8IPw', // ID Video YouTube dari Web Programming UNPAS
            'order' => 1,
        ]);
        $quizLaravel1 = Quiz::create(['material_id' => $materialLaravel1->id, 'title' => 'Kuis Instalasi Laravel']);
        $questionLaravel1 = Question::create(['quiz_id' => $quizLaravel1->id, 'question_text' => 'Manajer dependensi yang digunakan untuk menginstal Laravel adalah...']);
        Answer::create(['question_id' => $questionLaravel1->id, 'answer_text' => 'NPM', 'is_correct' => false]);
        Answer::create(['question_id' => $questionLaravel1->id, 'answer_text' => 'Composer', 'is_correct' => true]);
        Answer::create(['question_id' => $questionLaravel1->id, 'answer_text' => 'Yarn', 'is_correct' => false]);
    }
}
