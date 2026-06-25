<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::truncate();

        $materials = [
            [
                'title' => 'Singular & Plural Nouns',
                'slug' => 'singular-plural-nouns',
                'category' => 'structure',
                'description' => 'Pelajari perbedaan kata benda tunggal (singular) dan jamak (plural), aturan perubahan bentuknya, serta penggunaan irregular plural nouns dalam tes TOEFL.',
                'icon' => 'book-open',
                'read_time' => 7,
                'order_number' => 1,
                'content' => '
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Pendahuluan</h3>
                    <p class="text-slate-600 mb-4">
                        Dalam bagian <em>Structure and Written Expression</em> di tes TOEFL, kesalahan terkait penggunaan kata benda tunggal (singular) dan jamak (plural) sering kali diuji. Menguasai topik ini akan membantu Anda mengidentifikasi kesalahan gramatikal secara cepat.
                    </p>

                    <!-- Infographic Image -->
                    <div class="my-6 max-w-lg mx-auto border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                        <img src="/images/singular_plural_nouns.png" alt="Singular and Plural Nouns Infographic" class="w-full h-auto">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">1. Aturan Dasar Perubahan Singular ke Plural</h3>
                    <p class="text-slate-600 mb-3">Secara umum, kata benda jamak dibentuk dengan menambahkan akhiran <strong>-s</strong> atau <strong>-es</strong> pada bentuk tunggalnya.</p>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 space-y-2">
                        <li><strong>Cat</strong> menjadi <strong>Cats</strong> (penambahan -s)</li>
                        <li><strong>Box</strong> menjadi <strong>Boxes</strong> (penambahan -es untuk kata berakhiran -x, -ch, -sh, -s)</li>
                        <li><strong>Baby</strong> menjadi <strong>Babies</strong> (kata berakhiran konsonan + y berubah menjadi -ies)</li>
                    </ul>

                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-r-xl mb-6">
                        <h4 class="font-bold text-indigo-900 text-sm mb-1">Catatan Penting TOEFL: Irregular Plurals</h4>
                        <p class="text-xs text-indigo-700 leading-relaxed">
                            Beberapa kata benda memiliki bentuk jamak yang tidak beraturan (irregular) dan sangat sering muncul di tes TOEFL:
                        </p>
                        <ul class="list-disc pl-5 text-xs text-indigo-700 mt-2 space-y-1">
                            <li><strong>Child</strong> &rarr; <strong>Children</strong></li>
                            <li><strong>Man / Woman</strong> &rarr; <strong>Men / Women</strong></li>
                            <li><strong>Criterion</strong> &rarr; <strong>Criteria</strong></li>
                            <li><strong>Phenomenon</strong> &rarr; <strong>Phenomena</strong></li>
                            <li><strong>Analysis</strong> &rarr; <strong>Analyses</strong></li>
                        </ul>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">2. Countable vs. Uncountable Nouns</h3>
                    <p class="text-slate-600 mb-4">
                        Anda harus membedakan mana kata benda yang dapat dihitung (countable) dan tidak dapat dihitung (uncountable). Kata benda uncountable <strong>tidak boleh</strong> dijadikan bentuk jamak dengan menambahkan -s.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                            <h5 class="font-bold text-xs text-slate-500 uppercase mb-2">Countable Nouns (Bisa Dihitung)</h5>
                            <p class="text-sm text-slate-700">Dapat diawali dengan angka atau artikel <em>a/an</em> dan memiliki bentuk jamak.</p>
                            <p class="text-xs text-indigo-600 font-semibold mt-1">Contoh: Book, Apple, Student, Problem</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                            <h5 class="font-bold text-xs text-slate-500 uppercase mb-2">Uncountable Nouns (Tidak Bisa Dihitung)</h5>
                            <p class="text-sm text-slate-700">Selalu dianggap tunggal, tidak bisa ditambahi -s/es atau diawali angka secara langsung.</p>
                            <p class="text-xs text-indigo-600 font-semibold mt-1">Contoh: Water, Information, Furniture, Advice, Equipment</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">3. Contoh Soal TOEFL (Written Expression)</h3>
                    <div class="bg-slate-50 border border-slate-200 p-5 rounded-xl mb-4 font-mono text-sm">
                        <p class="text-slate-800">
                            The laboratory has modern <span class="underline font-bold">equipments</span> (A) for conducting <span class="underline font-bold">scientific</span> (B) research <span class="underline font-bold">on</span> (C) various <span class="underline font-bold">chemical</span> (D) substances.
                        </p>
                    </div>
                    <p class="text-slate-600 mb-4">
                        <strong>Analisis Jawaban:</strong> Jawaban yang salah adalah <strong>(A) equipments</strong>. Kata <em>equipment</em> adalah <em>uncountable noun</em> sehingga tidak boleh ditambahkan akhiran -s. Bentuk yang benar adalah <strong>equipment</strong>.
                    </p>

                    <!-- YouTube Video Embed -->
                    <h3 class="text-lg font-bold text-slate-800 mb-3">🎥 Video Pembelajaran</h3>
                    <p class="text-slate-600 mb-3">Saksikan video berikut untuk penjelasan visual yang menarik mengenai Singular & Plural Nouns:</p>
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md my-4">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/L4B7XxuJO6A?si=IrX0qUwy84NoJjDC" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                '
            ],
            [
                'title' => 'Subject-Verb Agreement',
                'slug' => 'subject-verb-agreement',
                'category' => 'structure',
                'description' => 'Kunci utama dalam menyelesaikan soal TOEFL Structure. Pelajari bagaimana mencocokkan subjek tunggal atau jamak dengan kata kerja yang sesuai, bahkan ketika terpisah oleh modifier.',
                'icon' => 'arrows-right-left',
                'read_time' => 8,
                'order_number' => 2,
                'content' => '
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Prinsip Utama</h3>
                    <p class="text-slate-600 mb-4">
                        Subjek dan kata kerja (verb) dalam sebuah kalimat harus selalu selaras (agree) dalam jumlah (number). Subjek tunggal memerlukan kata kerja tunggal, dan subjek jamak memerlukan kata kerja jamak.
                    </p>

                    <!-- Infographic Image -->
                    <div class="my-6 max-w-lg mx-auto border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                        <img src="/images/subject_verb_agreement.png" alt="Subject-Verb Agreement Infographic" class="w-full h-auto">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">1. Subjek Tunggal vs. Subjek Jamak</h3>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 space-y-2">
                        <li><strong>The dog barks</strong> &rarr; Subjek tunggal (dog) + verb tunggal (barks dengan akhiran -s).</li>
                        <li><strong>The dogs bark</strong> &rarr; Subjek jamak (dogs) + verb jamak (bark tanpa akhiran -s).</li>
                    </ul>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">2. Jebakan Prepositional Phrases (Modifier)</h3>
                    <p class="text-slate-600 mb-4">
                        Dalam tes TOEFL, pembuat soal sering kali meletakkan frasa preposisional di antara subjek dan kata kerja untuk mengalihkan perhatian Anda. Jangan terkecoh dengan kata benda di dalam frasa tersebut!
                    </p>

                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-r-xl mb-6">
                        <h4 class="font-bold text-indigo-900 text-sm mb-1">Rumus Penting:</h4>
                        <p class="text-sm font-mono text-indigo-800 mb-2">
                            Subject + [Prepositional Phrase / Modifier] + Verb
                        </p>
                        <p class="text-xs text-indigo-700 mt-2">
                            Verb harus tetap bersesuaian dengan <strong>Subject</strong> utama, bukan dengan kata benda di dalam kurung siku.
                        </p>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">3. Contoh Analisis Soal</h3>
                    <div class="bg-slate-50 border border-slate-200 p-5 rounded-xl mb-4 text-sm">
                        <p class="text-slate-800 font-semibold mb-2">Soal:</p>
                        <p class="text-slate-700 italic">
                            The key to these doors ________ on the table.
                        </p>
                        <p class="text-slate-600 mt-2 font-semibold">Pilihan jawaban:</p>
                        <p class="text-slate-600">(A) is &nbsp;&nbsp;&nbsp;&nbsp; (B) are</p>
                    </div>
                    <p class="text-slate-600 mb-4">
                        <strong>Pembahasan:</strong> Subjek kalimat di atas adalah <strong>The key</strong> (tunggal). Frasa <em>"to these doors"</em> hanyalah keterangan tambahan (prepositional phrase). Kata benda <em>doors</em> memang jamak, tetapi ia bukanlah subjek kalimat. Maka, kata kerja yang tepat adalah kata kerja tunggal yaitu <strong>(A) is</strong>.
                    </p>

                    <!-- YouTube Video Embed -->
                    <h3 class="text-lg font-bold text-slate-800 mb-3">🎥 Video Pembelajaran</h3>
                    <p class="text-slate-600 mb-3">Saksikan video berikut untuk memahami lebih dalam mengenai aturan Subject-Verb Agreement:</p>
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md my-4">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/KI6jX40WM3w?si=aHMQw9rgMCl0tE0J" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                '
            ],
            [
                'title' => 'Short Conversations Strategies',
                'slug' => 'short-conversations-strategies',
                'category' => 'listening',
                'description' => 'Strategi andalan untuk menjawab soal TOEFL Listening Part A. Pelajari cara fokus pada pembicara kedua, mengenali sinonim, dan menghindari jebakan bunyi yang mirip.',
                'icon' => 'microphone',
                'read_time' => 6,
                'order_number' => 3,
                'content' => '
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Gambaran Umum Part A</h3>
                    <p class="text-slate-600 mb-4">
                        Di bagian pertama Listening Comprehension (Part A), Anda akan mendengarkan percakapan pendek antara dua orang. Setelah percakapan selesai, narator akan membacakan sebuah pertanyaan. Kunci sukses di bagian ini adalah efisiensi waktu dan konsentrasi penuh.
                    </p>

                    <!-- Infographic Image -->
                    <div class="my-6 max-w-lg mx-auto border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                        <img src="/images/listening_strategies.png" alt="Short Conversations Strategies Infographic" class="w-full h-auto">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">Strategi 1: Fokus pada Baris Kedua (Second Speaker)</h3>
                    <p class="text-slate-600 mb-4">
                        Jawaban dari pertanyaan di Part A hampir selalu ditemukan pada kalimat yang diucapkan oleh **orang kedua** (pembicara kedua). Bacalah pilihan jawaban sembari mendengarkan pembicara kedua dengan seksama.
                    </p>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">Strategi 2: Cari Sinonim (Restatement)</h3>
                    <p class="text-slate-600 mb-4">
                        Pilihan jawaban yang benar sering kali merupakan **pernyataan ulang** (restatement) dari kata-kata kunci di pembicara kedua, tetapi menggunakan kosakata (vocabulary) yang berbeda atau sinonimnya.
                    </p>

                    <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-xl mb-6">
                        <h4 class="font-bold text-amber-900 text-sm mb-1">Awas Jebakan Bunyi Mirip (Similar Sounds)!</h4>
                        <p class="text-xs text-amber-800 leading-relaxed">
                            Hindari memilih jawaban yang memiliki bunyi pengucapan yang sangat mirip dengan kata yang terdengar di audio. Pilihan tersebut biasanya sengaja dibuat untuk menjebak peserta yang tidak memahami makna percakapan secara utuh.
                        </p>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">Contoh Soal</h3>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-4 text-sm space-y-2">
                        <p class="text-slate-700"><strong>(Man):</strong> Can you tell me if the library is open today?</p>
                        <p class="text-slate-700"><strong>(Woman):</strong> It\'s closed for the holiday.</p>
                        <p class="text-slate-700"><strong>(Narrator):</strong> What does the woman mean?</p>
                    </div>
                    <p class="text-slate-600 mb-2"><strong>Pilihan Jawaban:</strong></p>
                    <ul class="list-none text-slate-600 space-y-1 mb-4 pl-4">
                        <li>(A) She needs to go to the library.</li>
                        <li>(B) The library is not open because of a special day.</li>
                        <li>(C) The doors of the library are blue.</li>
                    </ul>
                    <p class="text-slate-600 mb-4">
                        <strong>Pembahasan:</strong> Pembicara kedua berkata <em>"It\'s closed for the holiday."</em> Kata <em>closed</em> bermakna sinonim dengan <em>not open</em>, dan <em>holiday</em> bersinonim dengan <em>special day</em>. Maka jawaban yang benar adalah <strong>(B)</strong>. Pilihan (C) menjebak dengan kata "doors" (bunyi mirip dengan "closed") dan tidak relevan.
                    </p>

                    <!-- YouTube Video Embed -->
                    <h3 class="text-lg font-bold text-slate-800 mb-3">🎥 Video Pembelajaran</h3>
                    <p class="text-slate-600 mb-3">Saksikan video berikut untuk latihan dan tips strategi Short Conversations di tes TOEFL:</p>
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md my-4">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/lOeSrhi1s_A?si=dMzWJLrV8gle6K9C" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                '
            ],
            [
                'title' => 'Finding the Main Idea',
                'slug' => 'finding-the-main-idea',
                'category' => 'reading',
                'description' => 'Cara cepat menentukan ide pokok/gagasan utama dari sebuah bacaan akademik tanpa harus membaca kata demi kata dari awal hingga akhir.',
                'icon' => 'academic-cap',
                'read_time' => 5,
                'order_number' => 4,
                'content' => '
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Pendahuluan</h3>
                    <p class="text-slate-600 mb-4">
                        Hampir setiap teks (passage) di bagian TOEFL Reading Comprehension akan menanyakan tentang gagasan utama (main idea). Pertanyaan ini bisa berbentuk: <em>"What is the main topic of the passage?"</em> atau <em>"What is the author\'s main purpose?"</em>.
                    </p>

                    <!-- Infographic Image -->
                    <div class="my-6 max-w-lg mx-auto border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                        <img src="/images/finding_main_idea.png" alt="Finding the Main Idea" class="w-full h-auto">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">Di Mana Menemukan Ide Pokok?</h3>
                    <p class="text-slate-600 mb-3">
                        Pada teks akademik TOEFL, ide pokok biasanya dapat ditemukan di:
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 space-y-2">
                        <li><strong>Kalimat pertama</strong> dari paragraf pertama.</li>
                        <li><strong>Kalimat pertama</strong> di setiap paragraf berikutnya (topic sentence).</li>
                    </ul>

                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-r-xl mb-6">
                        <h4 class="font-bold text-indigo-900 text-sm mb-1">Strategi Skimming</h4>
                        <p class="text-xs text-indigo-700 leading-relaxed">
                            Lakukan teknik membaca cepat (skimming) pada kalimat pertama setiap paragraf untuk mendapatkan gambaran besar topik bahasan secara keseluruhan dalam waktu kurang dari 30 detik.
                        </p>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">Tipe Pertanyaan Populer</h3>
                    <p class="text-slate-600 mb-3">Kenali pola pertanyaan ide pokok berikut agar Anda bisa langsung memahaminya di lembar soal:</p>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 font-mono text-sm space-y-1">
                        <li>What is the main idea of the passage?</li>
                        <li>What is the primary topic of the passage?</li>
                        <li>Which of the following would be the best title?</li>
                        <li>What is the author\'s main point in the passage?</li>
                    </ul>

                    <!-- YouTube Video Embed -->
                    <h3 class="text-lg font-bold text-slate-800 mb-3">🎥 Video Pembelajaran</h3>
                    <p class="text-slate-600 mb-3">Saksikan video berikut untuk mengetahui cara cepat menemukan gagasan utama pada paragraf:</p>
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md my-4">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/LbO3lRXT0ww?si=EiNZzmhNX3jIpvDn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                '
            ],
            [
                'title' => 'Coordinate & Adverb Clause Connectors',
                'slug' => 'coordinate-adverb-connectors',
                'category' => 'structure',
                'description' => 'Pelajari cara menghubungkan dua klausa menggunakan Coordinate Connectors (FANBOYS) dan Adverb Clause Connectors untuk membentuk kalimat majemuk yang kompleks dan gramatikal.',
                'icon' => 'link',
                'read_time' => 8,
                'order_number' => 5,
                'content' => '
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Pendahuluan</h3>
                    <p class="text-slate-600 mb-4">
                        Menghubungkan dua klausa dalam satu kalimat adalah konsep penting yang sering diuji dalam tes TOEFL. Anda harus memahami perbedaan antara <strong>Coordinate Connectors</strong> (penghubung koordinatif) dan <strong>Adverb Clause Connectors</strong> (penghubung klausa kata keterangan) agar struktur kalimat Anda tetap benar dan efisien.
                    </p>

                    <!-- Infographic Image -->
                    <div class="my-6 max-w-lg mx-auto border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                        <img src="/images/connectors_infographic.png" alt="Coordinate and Adverb Clause Connectors Infographic" class="w-full h-auto">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">1. Coordinate Connectors (FANBOYS)</h3>
                    <p class="text-slate-600 mb-3">
                        Coordinate connectors digunakan untuk menghubungkan dua klausa independen (equal clauses) yang setara secara tata bahasa. Singkatan populer untuk mengingatnya adalah <strong>FANBOYS</strong>:
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 space-y-1">
                        <li><strong>F</strong>or (Karena)</li>
                        <li><strong>A</strong>nd (Dan)</li>
                        <li><strong>N</strong>or (Maupun tidak)</li>
                        <li><strong>B</strong>ut (Tetapi)</li>
                        <li><strong>O</strong>r (Atau)</li>
                        <li><strong>Y</strong>et (Namun)</li>
                        <li><strong>S</strong>o (Sehingga)</li>
                    </ul>

                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-r-xl mb-6">
                        <h4 class="font-bold text-indigo-900 text-sm mb-1">Rumus Penting TOEFL (Coordinate Connectors):</h4>
                        <p class="text-sm font-mono text-indigo-800 mb-2">
                            Subject + Verb, + [coordinate connector] + Subject + Verb
                        </p>
                        <p class="text-xs text-indigo-700 leading-relaxed">
                            <strong>PENTING:</strong> Selalu gunakan tanda koma (<strong>,</strong>) sebelum coordinate connector saat menghubungkan dua klausa utama.
                        </p>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">2. Adverb Clause Connectors</h3>
                    <p class="text-slate-600 mb-3">
                        Adverb clause connectors (seperti <em>because, although, if, when, while, since</em>) menghubungkan klausa dependen (anak kalimat) dengan klausa independen (induk kalimat).
                    </p>
                    <p class="text-slate-600 mb-4">
                        Struktur ini memiliki dua pola penulisan yang sah tergantung pada posisi anak kalimatnya:
                    </p>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2 mb-6">
                        <p class="text-sm text-slate-850 font-mono"><strong>Pola A:</strong> Subject + Verb + [adverb connector] + Subject + Verb</p>
                        <p class="text-xs text-slate-500 italic">Contoh: She stayed inside because it was raining.</p>
                        <p class="text-sm text-slate-850 font-mono"><strong>Pola B:</strong> [Adverb connector] + Subject + Verb, + Subject + Verb</p>
                        <p class="text-xs text-slate-500 italic">Contoh: Because it was raining, she stayed inside.</p>
                    </div>

                    <!-- YouTube Video Embed -->
                    <h3 class="text-lg font-bold text-slate-800 mb-3">🎥 Video Pembelajaran</h3>
                    <p class="text-slate-600 mb-3">Saksikan video berikut untuk penjelasan visual yang lebih mendalam mengenai Coordinate Connectors:</p>
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md my-4">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/0p_oFwJ5o6o" title="Coordinate Connectors Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                '
            ],
            [
                'title' => 'Noun & Adjective Clause Connectors',
                'slug' => 'noun-adjective-connectors',
                'category' => 'structure',
                'description' => 'Pahami penggunaan Noun Clause Connectors dan Adjective Clause Connectors (Relative Pronouns) dalam menyusun klausa bertingkat yang sering kali diuji dalam bagian Structure TOEFL.',
                'icon' => 'square-3-stack-3d',
                'read_time' => 10,
                'order_number' => 6,
                'content' => '
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Pendahuluan</h3>
                    <p class="text-slate-600 mb-4">
                        Klausa bertingkat sering kali diuji dalam bagian Structure. Dua jenis klausa dependen yang sangat sering muncul adalah <strong>Noun Clauses</strong> (klausa kata benda) dan <strong>Adjective Clauses</strong> (klausa kata sifat / relative clauses). Membedakan dan mengetahui konektor yang tepat dari kedua klausa ini akan meningkatkan akurasi jawaban Anda.
                    </p>

                    <!-- Infographic Image -->
                    <div class="my-6 max-w-lg mx-auto border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                        <img src="/images/clauses_infographic.png" alt="Noun and Adjective Clause Connectors Infographic" class="w-full h-auto">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">1. Noun Clause Connectors</h3>
                    <p class="text-slate-600 mb-3">
                        Noun clause adalah klausa dependen yang berfungsi sebagai kata benda dalam sebuah kalimat (sebagai subjek, objek dari kata kerja, atau objek dari preposisi).
                    </p>
                    <p class="text-slate-600 mb-3">Konektor umum: <em>what, when, where, why, how, whether, if, that</em>.</p>
                    <div class="bg-indigo-50 border-l-4 border-indigo-600 p-4 rounded-r-xl mb-6">
                        <h4 class="font-bold text-indigo-900 text-sm mb-2">Pola Noun Clause:</h4>
                        <div class="space-y-1.5 text-sm font-mono text-indigo-850">
                            <p>1. Sebagai Objek: Subject + Verb + [connector + Subject + Verb]</p>
                            <p class="text-xs text-indigo-700 italic">Contoh: I know what you did.</p>
                            <p>2. Sebagai Subjek: [Connector + Subject + Verb] + Verb</p>
                            <p class="text-xs text-indigo-700 italic">Contoh: What you did was wrong.</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">2. Adjective Clause Connectors (Relative Pronouns)</h3>
                    <p class="text-slate-600 mb-3">
                        Adjective clause adalah klausa dependen yang memodifikasi atau menjelaskan kata benda sebelum kata tersebut (antecedent).
                    </p>
                    <p class="text-slate-600 mb-3">Konektor umum:</p>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 space-y-1">
                        <li><strong>Who / Whom</strong> (untuk manusia)</li>
                        <li><strong>Which</strong> (untuk benda/hewan)</li>
                        <li><strong>That</strong> (untuk manusia/benda)</li>
                    </ul>

                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 space-y-2 mb-6">
                        <h4 class="font-bold text-xs text-slate-500 uppercase mb-2">Contoh Kalimat Adjective Clause:</h4>
                        <p class="text-sm text-slate-800">The book <strong>which</strong> you bought yesterday is excellent.</p>
                        <p class="text-xs text-slate-500 italic">Keterangan: "which you bought yesterday" menjelaskan kata benda "The book".</p>
                    </div>

                    <!-- YouTube Video Embed -->
                    <h3 class="text-lg font-bold text-slate-800 mb-3">🎥 Video Pembelajaran</h3>
                    <p class="text-slate-600 mb-3">Tonton video tutorial lanjutan mengenai Noun Clauses untuk mematangkan pemahaman Anda:</p>
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md my-4">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/3uJZMi5Jlh0?si=nw6ASdJpjMxnwYp0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                '
            ],
            [
                'title' => 'Skimming, Scanning, and Vocabulary',
                'slug' => 'skimming-scanning-vocabulary',
                'category' => 'reading',
                'description' => 'Kuasai three teknik fundamental dalam TOEFL Reading Comprehension: Skimming untuk mendapatkan gagasan umum, Scanning untuk menemukan informasi spesifik, dan memprediksi makna Vocabulary dalam konteks.',
                'icon' => 'magnifying-glass',
                'read_time' => 9,
                'order_number' => 7,
                'content' => '
                    <h3 class="text-lg font-bold text-slate-800 mb-3">Pendahuluan</h3>
                    <p class="text-slate-600 mb-4">
                        TOEFL Reading Comprehension membutuhkan strategi efisiensi waktu karena Anda harus membaca teks panjang dan menjawab 50 soal dalam waktu terbatas. Tiga keterampilan paling esensial untuk menghemat waktu adalah <strong>Skimming</strong> (membaca sekilas), <strong>Scanning</strong> (memindai cepat), dan menebak <strong>Vocabulary in Context</strong> (kosakata dalam konteks).
                    </p>

                    <!-- Infographic Image -->
                    <div class="my-6 max-w-lg mx-auto border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                        <img src="/images/skimming_scanning_graphic.png" alt="Skimming, Scanning, and Vocabulary" class="w-full h-auto">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">1. Skimming (Mencari Gagasan Utama)</h3>
                    <p class="text-slate-600 mb-3">
                        Skimming adalah teknik membaca cepat dengan melompati kata-kata untuk menemukan gambaran besar (gist) atau struktur dasar dari sebuah bacaan.
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 space-y-1">
                        <li>Baca judul teks dan subjudul jika ada.</li>
                        <li>Fokuslah pada paragraf pembuka (introduksi) dan paragraf kesimpulan.</li>
                        <li>Baca baris pertama (topic sentence) dari setiap paragraf isi.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">2. Scanning (Mencari Fakta Spesifik)</h3>
                    <p class="text-slate-600 mb-3">
                        Scanning digunakan saat Anda sudah membaca pertanyaan dan mencari kata kunci spesifik (seperti angka, tahun, nama orang, lokasi, atau istilah teknis) tanpa perlu memahami isi bacaan keseluruhan.
                    </p>
                    <ul class="list-disc pl-6 text-slate-600 mb-4 space-y-1">
                        <li>Biarkan mata Anda meluncur cepat ke bawah halaman mencari pola visual kata kunci tersebut.</li>
                        <li>Setelah menemukan kata kunci, bacalah kalimat utuh di sekitar kata kunci tersebut untuk menjawab pertanyaan.</li>
                    </ul>

                    <h3 class="text-lg font-bold text-slate-800 mb-3">3. Vocabulary in Context (Menebak Kosakata)</h3>
                    <p class="text-slate-600 mb-4">
                        Saat menghadapi kata sulit yang tidak Anda ketahui artinya, bacalah kalimat sebelum dan sesudahnya untuk mencari <strong>context clues</strong> (petunjuk konteks) seperti definisi langsung, sinonim, atau kontras yang disisipkan oleh penulis.
                    </p>

                    <!-- YouTube Video Embed -->
                    <h3 class="text-lg font-bold text-slate-800 mb-3">🎥 Video Pembelajaran</h3>
                    <p class="text-slate-600 mb-3">Berikut panduan video praktis untuk mengasah skill Skimming dan Scanning Anda:</p>
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md my-4">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/7etaXjWJVJg?si=6gWAWbm_cLduaqzy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                '
            ]
        ];

        foreach ($materials as $m) {
            Material::create($m);
        }
    }
}
