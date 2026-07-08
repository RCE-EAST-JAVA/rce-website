<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title'        => 'Mengapa Pendidikan untuk Pembangunan Berkelanjutan Penting bagi Generasi Muda',
                'category'     => 'Journal',
                'author'       => 'Dr. Aliyah Purnamasari, M.Hum.',
                'tags'         => 'ESD, generasi muda, pembangunan berkelanjutan',
                'excerpt'      => 'Pendidikan untuk Pembangunan Berkelanjutan (ESD) bukan sekadar kurikulum — ia adalah fondasi cara berpikir kritis yang dibutuhkan generasi muda untuk menghadapi krisis iklim dan ketimpangan sosial.',
                'body'         => '<h2>Apa Itu ESD?</h2><p>Pendidikan untuk Pembangunan Berkelanjutan (ESD) adalah pendekatan pembelajaran yang membekali peserta didik dengan pengetahuan, keterampilan, dan nilai-nilai untuk berkontribusi pada masa depan yang lebih adil dan berkelanjutan.</p><h2>Mengapa Ini Mendesak?</h2><p>Di tengah krisis iklim yang semakin nyata, generasi muda tidak bisa hanya mengandalkan kurikulum konvensional. Mereka perlu memahami keterkaitan antara ekologi, ekonomi, dan keadilan sosial secara holistik.</p><h2>Peran RCE Jawa Timur</h2><p>RCE Jawa Timur aktif mengintegrasikan prinsip ESD ke dalam program pelatihan guru, kurikulum lokal, dan kegiatan komunitas di seluruh provinsi. Kolaborasi lintas sektor menjadi kunci keberhasilan pendekatan ini.</p>',
                'status'       => 'published',
                'published_at' => '2026-03-10',
            ],
            [
                'title'        => 'Inovasi Pengelolaan Sampah Organik di Kampung Hijau Surabaya',
                'category'     => 'Books',
                'author'       => 'Dr. H. Ahmad Yani, M.T.',
                'tags'         => 'sampah organik, kompos, komunitas, Surabaya',
                'excerpt'      => 'Kampung Hijau di kawasan Wonokromo, Surabaya, berhasil mengubah sampah dapur menjadi sumber pendapatan komunitas lewat program bank sampah dan produksi pupuk kompos skala lingkungan.',
                'body'         => '<h2>Latar Belakang</h2><p>Surabaya menghasilkan lebih dari 1.500 ton sampah per hari. Sebagian besar berasal dari sampah organik rumah tangga yang berakhir di TPA tanpa pengolahan berarti.</p><h2>Program Bank Sampah Organik</h2><p>Warga Kampung Hijau Wonokromo membentuk kelompok pengelola bank sampah organik yang mengumpulkan sisa dapur, dedaunan, dan limbah pertanian untuk diolah menjadi kompos. Hasilnya dijual ke kebun komunitas dan petani sekitar.</p><h2>Dampak Nyata</h2><p>Dalam 6 bulan pertama, kampung ini berhasil mengurangi volume sampah yang dikirim ke TPA sebesar 40%. Pendapatan komunitas dari penjualan kompos mencapai Rp 3 juta per bulan.</p><h2>Replikasi ke Wilayah Lain</h2><p>Model ini kini sedang direplikasi di 5 kelurahan lain di Surabaya dengan pendampingan dari tim RCE Jawa Timur dan dukungan Dinas Lingkungan Hidup Kota Surabaya.</p>',
                'status'       => 'published',
                'published_at' => '2026-04-02',
            ],
            [
                'title'        => 'Panel Surya Komunitas: Solusi Energi Bersih untuk Desa Terpencil',
                'category'     => 'Intellectual Rights',
                'author'       => 'Ali Solihin, M.T.',
                'tags'         => 'energi terbarukan, panel surya, desa, SDG 7',
                'excerpt'      => 'Proyek pemasangan panel surya komunal di Desa Tanjungbumi, Bangkalan, membuktikan bahwa energi bersih bukan hanya hak kota besar — desa pun bisa mandiri secara energi.',
                'body'         => '<h2>Tantangan Energi di Desa Terpencil</h2><p>Desa Tanjungbumi di Bangkalan, Madura, selama bertahun-tahun hanya mengandalkan genset diesel yang mahal dan mencemari udara. Tidak kurang dari 30% keluarga masih belum teraliri listrik PLN secara stabil.</p><h2>Solusi Panel Surya Komunal</h2><p>Tim RCE Jawa Timur bersama mahasiswa ITS memasang sistem panel surya komunal berkapasitas 10 kWp yang mampu menyuplai kebutuhan listrik 40 rumah tangga sekaligus penerangan jalan desa.</p><h2>Pelatihan dan Perawatan</h2><p>Agar sistem berkelanjutan, warga desa dilatih dasar-dasar perawatan panel dan sistem baterai. Terbentuknya kelompok energi desa memastikan pengelolaan jangka panjang tanpa ketergantungan penuh pada teknisi luar.</p><h2>Ke Depan</h2><p>Keberhasilan Tanjungbumi menjadi model percontohan bagi 12 desa lain di kepulauan Madura yang kondisinya serupa.</p>',
                'status'       => 'published',
                'published_at' => '2026-04-18',
            ],
            [
                'title'        => 'Pemulihan Ekosistem Mangrove di Pesisir Delta Brantas',
                'category'     => 'Journal',
                'author'       => 'Dr. Shinta Rahayu, M.Si.',
                'tags'         => 'mangrove, ekosistem pesisir, Brantas, SDG 14',
                'excerpt'      => 'Kawasan delta Sungai Brantas kehilangan lebih dari 60% tutupan mangrove dalam dua dekade terakhir. Program pemulihan bersama RCE Jawa Timur kini menanam harapan baru di pesisir.',
                'body'         => '<h2>Kondisi Mangrove Saat Ini</h2><p>Data citra satelit menunjukkan bahwa kawasan mangrove di delta Brantas, Gresik dan Sidoarjo, menyusut dari sekitar 2.400 hektar pada tahun 2000 menjadi kurang dari 900 hektar saat ini. Alih fungsi lahan tambak dan pembangunan industri menjadi penyebab utama.</p><h2>Program Penanaman Partisipatif</h2><p>RCE Jawa Timur bekerja sama dengan komunitas nelayan, mahasiswa, dan pemerintah daerah melangsungkan penanaman massal bibit bakau sejenis <em>Rhizophora mucronata</em> dan <em>Avicennia marina</em>. Setiap aksi tanam melibatkan lebih dari 200 relawan.</p><h2>Manfaat Ekologis dan Ekonomi</h2><p>Mangrove yang pulih bukan hanya menjadi habitat ikan dan kepiting, tapi juga pelindung alami pantai dari abrasi. Nelayan lokal melaporkan peningkatan tangkapan ikan setelah dua tahun program berjalan.</p>',
                'status'       => 'published',
                'published_at' => '2026-05-05',
            ],
            [
                'title'        => 'Forum ESD Jawa Timur 2026: Memperkuat Jaringan Pendidikan Berkelanjutan',
                'category'     => 'Books',
                'author'       => 'Admin RCE East Java',
                'tags'         => 'forum, ESD, jaringan, Jawa Timur',
                'excerpt'      => 'Forum ESD Jawa Timur 2026 mempertemukan lebih dari 150 praktisi pendidikan, peneliti, dan pemangku kebijakan untuk merancang strategi kolaboratif menuju pendidikan berkelanjutan yang inklusif.',
                'body'         => '<h2>Tentang Forum</h2><p>Forum ESD Jawa Timur 2026 diselenggarakan pada 20–21 Mei 2026 di Universitas Airlangga, Surabaya. Acara ini menjadi ajang tahunan RCE Jawa Timur untuk mempertemukan pemangku kepentingan dari sektor pendidikan, pemerintah, LSM, dan dunia usaha.</p><h2>Tema Tahun Ini</h2><p>Mengusung tema <strong>"Kolaborasi Lintas Sektor untuk ESD yang Inklusif dan Berdampak"</strong>, forum ini berfokus pada praktik terbaik integrasi ESD di sekolah formal, pendidikan vokasi, dan pembelajaran komunitas.</p><h2>Hasil dan Rekomendasi</h2><p>Forum menghasilkan dokumen rekomendasi kebijakan yang akan disampaikan ke Dinas Pendidikan Provinsi Jawa Timur, mencakup kurikulum berbasis ESD, pelatihan guru, dan pengembangan indikator dampak pembelajaran berkelanjutan.</p><h2>Partisipasi</h2><p>Tercatat 152 peserta hadir dari 28 kabupaten/kota di Jawa Timur, serta perwakilan dari 6 universitas mitra RCE. Dokumentasi lengkap forum tersedia di website RCE Jawa Timur.</p>',
                'status'       => 'published',
                'published_at' => '2026-05-22',
            ],
            [
                'title'        => 'Kurikulum ESD Tingkat Sekolah Dasar',
                'category'     => 'Intellectual Rights',
                'author'       => 'Dr. Aliyah Purnamasari, M.Hum.',
                'tags'         => 'kurikulum, sekolah dasar, ESD',
                'excerpt'      => 'Draft kurikulum ESD untuk tingkat SD sedang dalam tahap penyusunan dan akan diujicobakan di 10 sekolah percontohan mulai semester genap 2026.',
                'body'         => '<p>Artikel ini masih dalam proses penulisan dan akan segera dipublikasikan.</p>',
                'status'       => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($articles as $data) {
            Article::create([
                'title'        => $data['title'],
                'slug'         => Str::slug($data['title']),
                'category'     => $data['category'],
                'author'       => $data['author'] ?? null,
                'tags'         => $data['tags'] ?? null,
                'excerpt'      => $data['excerpt'],
                'body'         => $data['body'],
                'status'       => $data['status'],
                'published_at' => $data['published_at'],
                'thumbnail'    => null,
            ]);
        }
    }
}
