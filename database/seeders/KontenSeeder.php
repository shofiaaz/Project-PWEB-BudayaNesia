<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Untuk timestamp

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('konten')->insert([
            [
                'thumbnail' => 'konten-thumbnails/d8YUNkuvQImqgU5mnXrMHmtt1w5jeuHpiBNWpxuk.jpg',
                'judul' => 'tari gandrung',
                'isi' => 'Tari Gandrung adalah salah satu tarian tradisional khas Indonesia yang sangat populer, terutama berasal dari Banyuwangi, Jawa Timur. Meskipun ada varian tari Gandrung di beberapa daerah lain seperti Lombok dan Bali, yang paling dikenal luas adalah Gandrung Banyuwangi.

Asal-usul dan Sejarah

Tari Gandrung memiliki sejarah panjang dan akar budaya yang kuat, terutama dalam tradisi **Suku Osing**, penduduk asli Banyuwangi. Awalnya, tarian ini berfungsi sebagai **perwujudan rasa syukur masyarakat agraris setelah masa panen**. Ada keterkaitan erat dengan **Dewi Sri**, dewi kesuburan dalam kepercayaan masyarakat.

Pada awalnya, tari Gandrung sering ditarikan oleh **laki-laki yang berbusana seperti perempuan** (disebut *Gandrung Lanang*). Seiring perkembangan zaman, terutama sekitar awal abad ke-20, penari laki-laki mulai digantikan oleh **penari perempuan** (dikenal sebagai *Gandrung Putri*) yang lebih populer dan bertahan hingga saat ini.

---

## Ciri Khas Tari Gandrung Banyuwangi

Beberapa ciri khas yang membedakan tari Gandrung Banyuwangi antara lain:

* **Pementasan Berpasangan**: Tari ini umumnya dipentaskan secara berpasangan antara seorang penari perempuan (*gandrung*) dan seorang laki-laki (*pemaju* atau *paju*) dari kalangan penonton yang diajak menari bersama.
* **Musik Pengiring**: Iringan musiknya khas, perpaduan unsur gamelan Jawa dan Bali, dengan dominasi instrumen kendang yang dinamis.
* **Busana Penari**: Penari Gandrung mengenakan busana yang khas, seringkali berupa baju beludru hitam berhias ornamen emas dan manik-manik, serta hiasan kepala menyerupai mahkota (disebut *gelungan*) yang dihiasi bunga cempaka putih. Bagian pundak dan separuh punggung biasanya dibiarkan terbuka.
* **Gerakan**: Gerakan tari Gandrung umumnya dinamis, luwes, dan ekspresif, mencerminkan kegembiraan dan rasa syukur. Ada bagian-bagian tertentu dalam pementasan, seperti *bapangan* (penari mengelilingi arena) dan *gandrungan* (penari bergerak lebih lincah dengan kipas).
* **Fungsi Sosial dan Ritual**: Selain sebagai hiburan, tari Gandrung juga memiliki fungsi ritual, seperti tolak bala, dan fungsi sosial sebagai pengikat solidaritas masyarakat dalam berbagai acara (perkawinan, khitanan, perayaan, hingga acara resmi).

Tari Gandrung tidak hanya sekadar pertunjukan seni, tetapi juga merupakan **simbol identitas budaya Banyuwangi** yang kaya akan makna dan nilai-nilai kehidupan.',
                'kategori' => 'tarian',
                'status' => 'approved',
                'asal' => 'Jawa Timur',
                'akun_id' => 2,
                'views_count' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'thumbnail' => 'konten-thumbnails/mdtmeMKeg1xWQRFmztqFXO4zB3V5ArxWabFtjIjn.jpg',
                'judul' => 'Tari Kecak',
                'isi' => 'Tari Kecak adalah sebuah seni pertunjukan drama tari yang unik dan ikonik dari Bali, Indonesia. Tarian ini sangat berbeda dari tari Bali lainnya karena tidak diiringi oleh instrumen musik gamelan. Sebagai gantinya, iringan musik dihasilkan dari paduan suara sekitar seratus atau lebih penari laki-laki yang duduk melingkar dan menyerukan kata "cak" secara ritmis, disertai dengan gerakan-gerakan tangan yang bervariasi.

---

Asal-usul dan Inspirasi

Tari Kecak awalnya merupakan bagian dari ritual Sanghyang, sebuah tarian sakral yang bertujuan untuk mengusir roh jahat dan berkomunikasi dengan roh leluhur. Pada tahun 1930-an, seorang seniman Jerman bernama Walter Spies bersama seniman lokal Bali, I Wayan Limbak, mengembangkan tari ini menjadi sebuah pertunjukan drama tari yang terinspirasi dari kisah Ramayana. Mereka melihat potensi visual dan naratif dari ritual Sanghyang dan mengadaptasinya agar bisa dinikmati oleh khalayak yang lebih luas.

---

Ciri Khas dan Pementasan

* Paduan Suara "Cak": Ini adalah elemen paling khas dari Tari Kecak. Ratusan penari laki-laki duduk melingkar, mengangkat tangan ke atas, dan secara serempak menyerukan "cak, cak, cak" dengan berbagai tempo dan intonasi, menciptakan orkestra suara yang magis dan hipnotis.
* Kisah Ramayana: Sebagian besar pementasan Tari Kecak mengangkat fragmen-fragmen epik Ramayana, terutama kisah penculikan Dewi Sita oleh Rahwana dan perjuangan Rama yang dibantu oleh pasukan kera Hanoman untuk menyelamatkannya. Penari-penari yang duduk melingkar berperan sebagai pasukan kera (vanara).
* Tanpa Iringan Gamelan: Tidak adanya instrumen musik tradisional membuatnya sangat berbeda dan menonjol. Kekuatan pertunjukan terletak pada suara manusia dan gerakan kolektif.
* Pakaian: Para penari laki-laki biasanya hanya mengenakan kain kotak-kotak hitam putih yang melilit pinggang mereka, menyerupai kain poleng khas Bali. Penari yang memerankan tokoh-tokoh Ramayana mengenakan kostum yang lebih spesifik sesuai karakter mereka.
* Lokasi Pementasan: Tari Kecak sering dipentaskan di tempat-tempat terbuka, terutama saat senja menjelang malam, dengan latar belakang matahari terbenam atau api obor yang menyala di tengah lingkaran penari, menambah suasana dramatis.

Tari Kecak bukan hanya sekadar tarian, tetapi juga sebuah pengalaman budaya yang mendalam, mencerminkan kekayaan warisan spiritual dan seni Bali yang dinamis.',
                'kategori' => 'tarian',
                'status' => 'approved',
                'asal' => 'Bali',
                'akun_id' => 2,
                'views_count' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'thumbnail' => 'konten-thumbnails/jrSOuia7aKfzulTLX6msWigjwjMmpYUhJzJiG6YS.jpg',
                'judul' => 'Wayang',
                'isi' => 'Wayang adalah sebuah seni pertunjukan tradisional Indonesia yang memiliki sejarah panjang dan nilai filosofis yang mendalam. Kata "wayang" sendiri berasal dari bahasa Jawa yang berarti "bayangan" atau "imajinasi," yang mengacu pada pertunjukan wayang kulit yang mengandalkan bayangan boneka di layar. Namun, dalam konteks yang lebih luas, "wayang" juga dapat merujuk pada boneka atau figur yang digunakan dalam pertunjukan itu sendiri.

---

### Sejarah dan Fungsi Wayang

Wayang diyakini telah ada di Indonesia sejak abad ke-8 Masehi, dengan akar kuat dalam ritual dan kepercayaan animisme kuno yang memuja roh nenek moyang. Seiring masuknya agama Hindu dan Buddha, cerita-cerita dari epos besar seperti **Ramayana** dan **Mahabharata** diadaptasi ke dalam pertunjukan wayang, menjadi media penyebaran nilai-nilai moral dan spiritual.

Kemudian, pada masa penyebaran Islam, khususnya oleh **Wali Songo** di Jawa, wayang digunakan sebagai alat dakwah yang efektif. Cerita dan karakter diadaptasi agar selaras dengan ajaran Islam, menjadikannya media komunikasi, pendidikan, dan hiburan yang sangat populer di masyarakat.

Wayang diakui oleh UNESCO sebagai **Mahakarya Warisan Budaya Lisan dan Tak Benda Kemanusiaan (Masterpiece of Oral and Intangible Heritage of Humanity)** pada tahun 2003, menandakan pentingnya wayang dalam warisan budaya dunia.

---

### Jenis-jenis Wayang

Indonesia memiliki berbagai jenis wayang, masing-masing dengan karakteristik unik dalam bentuk, bahan, dan cara pementasannya:

* **Wayang Kulit:** Ini adalah jenis wayang yang paling terkenal, terutama di Jawa dan Bali. Figur wayang dibuat dari **kulit kerbau** yang ditatah halus dan diwarnai, kemudian dimainkan di balik layar putih dengan sorotan lampu sehingga menghasilkan bayangan. Dalang (seniman yang memainkan wayang) bercerita sambil menggerakkan wayang dan diiringi musik gamelan.
* **Wayang Golek:** Populer di Jawa Barat (Sunda), wayang golek adalah boneka **kayu tiga dimensi** yang dimainkan oleh dalang. Bentuknya lebih menyerupai patung manusia, dan pertunjukannya tidak menggunakan layar bayangan.
* **Wayang Orang (Wayang Wong):** Ini adalah bentuk drama tari di mana **manusia** memerankan tokoh-tokoh wayang secara langsung. Para penari mengenakan kostum, riasan, dan topeng (kadang-kadang) sesuai dengan karakter yang mereka perankan, menarikan adegan-adegan dari epos Ramayana atau Mahabharata.
* **Wayang Klithik:** Mirip dengan wayang kulit, tetapi terbuat dari **kayu pipih** dan sering dimainkan di Jawa Timur. Bentuknya lebih kaku dibandingkan wayang kulit.
* **Wayang Beber:** Dianggap sebagai salah satu bentuk wayang tertua, wayang beber menggunakan **gulungan lukisan** yang dibuka secara bertahap oleh dalang untuk menceritakan kisah.

---

### Makna Budaya

Lebih dari sekadar pertunjukan, wayang adalah cerminan kompleksitas kehidupan manusia. Setiap karakter, gerakan, dialog, dan bahkan musik yang mengiringi mengandung pesan moral, filosofis, dan sosial. Wayang seringkali menjadi media untuk menyampaikan kritik sosial, nasihat, atau ajaran agama, menjadikannya bagian tak terpisahkan dari kehidupan budaya masyarakat Indonesia.',
                'kategori' => 'musik', 
                'status' => 'approved',
                'asal' => 'Jawa Timur',
                'akun_id' => 3,
                'views_count' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
