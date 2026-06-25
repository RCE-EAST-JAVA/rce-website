<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdgController extends Controller
{
    private function getSdgs(): array
    {
        return [
            [
                'number'      => 1,
                'title'       => 'Tanpa Kemiskinan',
                'description' => 'Mengakhiri segala bentuk kemiskinan di semua tempat.',
                'targets'     => 7,
                'detail'      => 'SDG 1 bertujuan untuk mengakhiri kemiskinan dalam segala bentuknya di seluruh dunia. Ini mencakup kemiskinan ekstrem, akses terhadap sumber daya ekonomi, serta perlindungan sosial bagi kelompok rentan.',
                'points'      => [
                    'Memberantas kemiskinan ekstrem bagi semua orang di mana pun',
                    'Mengurangi setidaknya setengah proporsi penduduk yang hidup dalam kemiskinan',
                    'Menerapkan sistem perlindungan sosial yang tepat secara nasional',
                    'Menjamin bahwa semua pria dan wanita memiliki hak atas sumber daya ekonomi',
                    'Membangun ketahanan masyarakat miskin dan rentan terhadap bencana',
                ],
                'rce_action'  => 'RCE Jawa Timur mendukung program pemberdayaan ekonomi komunitas melalui pelatihan vokasi, pengembangan usaha mikro, dan pendampingan kelompok rentan di berbagai kabupaten/kota Jawa Timur.',
            ],
            [
                'number'      => 2,
                'title'       => 'Tanpa Kelaparan',
                'description' => 'Mengakhiri kelaparan, mencapai ketahanan pangan dan gizi yang baik, serta meningkatkan pertanian berkelanjutan.',
                'targets'     => 8,
                'detail'      => 'SDG 2 berfokus pada pencapaian ketahanan pangan, perbaikan gizi, dan peningkatan pertanian berkelanjutan. Tujuan ini mengakui keterkaitan antara pertanian, gizi, dan keberlanjutan lingkungan.',
                'points'      => [
                    'Mengakhiri kelaparan dan menjamin akses pangan bergizi bagi semua orang',
                    'Mengakhiri segala bentuk kekurangan gizi, termasuk stunting pada anak',
                    'Menggandakan produktivitas pertanian dan pendapatan petani skala kecil',
                    'Menjamin sistem produksi pangan yang berkelanjutan',
                    'Menjaga keragaman genetik benih dan tanaman budidaya',
                ],
                'rce_action'  => 'RCE Jawa Timur mendukung pertanian organik, urban farming, dan program edukasi gizi masyarakat bekerja sama dengan dinas pertanian dan institusi riset pangan di Jawa Timur.',
            ],
            [
                'number'      => 3,
                'title'       => 'Kehidupan Sehat dan Sejahtera',
                'description' => 'Menjamin kehidupan yang sehat dan meningkatkan kesejahteraan seluruh penduduk semua usia.',
                'targets'     => 13,
                'detail'      => 'SDG 3 mencakup berbagai aspek kesehatan mulai dari kesehatan ibu dan anak, penanganan penyakit menular dan tidak menular, kesehatan mental, hingga akses layanan kesehatan universal.',
                'points'      => [
                    'Mengurangi angka kematian ibu dan bayi',
                    'Mengakhiri epidemi AIDS, TBC, malaria, dan penyakit tropis terabaikan',
                    'Mengurangi kematian akibat penyakit tidak menular',
                    'Memperkuat pencegahan dan pengobatan penyalahgunaan zat',
                    'Mencapai cakupan kesehatan universal',
                ],
                'rce_action'  => 'RCE Jawa Timur mengintegrasikan pendidikan kesehatan lingkungan dalam kurikulum sekolah dan program komunitas, termasuk kampanye sanitasi dan perilaku hidup bersih sehat.',
            ],
            [
                'number'      => 4,
                'title'       => 'Pendidikan Berkualitas',
                'description' => 'Menjamin kualitas pendidikan yang inklusif dan merata serta meningkatkan kesempatan belajar sepanjang hayat untuk semua.',
                'targets'     => 10,
                'detail'      => 'SDG 4 adalah inti dari misi RCE Jawa Timur. Education for Sustainable Development (ESD) menjadi pendekatan utama untuk memastikan setiap orang mendapat akses pendidikan berkualitas yang relevan dengan tantangan abad ke-21.',
                'points'      => [
                    'Menjamin semua anak perempuan dan laki-laki menyelesaikan pendidikan dasar dan menengah',
                    'Menjamin akses terhadap pendidikan anak usia dini yang berkualitas',
                    'Menjamin akses setara bagi semua ke pendidikan vokasi dan tinggi',
                    'Meningkatkan jumlah pemuda dan orang dewasa yang memiliki keterampilan relevan',
                    'Menjamin semua pelajar memperoleh pengetahuan dan keterampilan ESD',
                ],
                'rce_action'  => 'ESD adalah fokus utama RCE Jawa Timur. Kami mengembangkan kurikulum berbasis keberlanjutan, melatih guru, dan menjalin kemitraan antara universitas, sekolah, dan komunitas.',
            ],
            [
                'number'      => 5,
                'title'       => 'Kesetaraan Gender',
                'description' => 'Mencapai kesetaraan gender dan memberdayakan kaum perempuan.',
                'targets'     => 9,
                'detail'      => 'SDG 5 bertujuan untuk mengakhiri diskriminasi terhadap perempuan dan anak perempuan, menghapus kekerasan berbasis gender, dan memastikan partisipasi penuh perempuan dalam kehidupan publik.',
                'points'      => [
                    'Mengakhiri segala bentuk diskriminasi terhadap perempuan',
                    'Menghapuskan kekerasan terhadap perempuan di ruang publik dan privat',
                    'Mengakhiri perkawinan anak dan sunat perempuan',
                    'Menghargai pekerjaan perawatan dan rumah tangga yang tidak dibayar',
                    'Menjamin partisipasi penuh perempuan dalam kepemimpinan',
                ],
                'rce_action'  => 'RCE Jawa Timur mendorong keterwakilan perempuan dalam program riset, kepemimpinan komunitas, dan pengambilan keputusan di bidang lingkungan dan pembangunan.',
            ],
            [
                'number'      => 6,
                'title'       => 'Air Bersih dan Sanitasi Layak',
                'description' => 'Menjamin ketersediaan serta pengelolaan air bersih dan sanitasi yang berkelanjutan untuk semua.',
                'targets'     => 8,
                'detail'      => 'SDG 6 mencakup akses air minum yang aman, sanitasi yang layak, kebersihan, kualitas air, efisiensi penggunaan air, pengelolaan ekosistem terkait air, serta kerjasama internasional dalam tata kelola air.',
                'points'      => [
                    'Mencapai akses universal dan merata terhadap air minum yang aman',
                    'Mencapai akses sanitasi dan kebersihan yang layak bagi semua',
                    'Meningkatkan kualitas air dengan mengurangi polusi',
                    'Meningkatkan efisiensi penggunaan air secara substansial',
                    'Melindungi dan merestorasi ekosistem terkait air',
                ],
                'rce_action'  => 'RCE Jawa Timur aktif dalam program konservasi DAS Brantas, edukasi pengelolaan air komunitas, dan advokasi sanitasi layak di kawasan pesisir dan pedesaan.',
            ],
            [
                'number'      => 7,
                'title'       => 'Energi Bersih dan Terjangkau',
                'description' => 'Menjamin akses energi yang terjangkau, andal, berkelanjutan, dan modern untuk semua.',
                'targets'     => 5,
                'detail'      => 'SDG 7 berfokus pada tiga aspek utama: akses universal terhadap layanan energi, peningkatan pangsa energi terbarukan, dan peningkatan efisiensi energi secara global.',
                'points'      => [
                    'Menjamin akses universal terhadap layanan energi modern yang terjangkau',
                    'Meningkatkan secara substansial pangsa energi terbarukan dalam bauran energi global',
                    'Menggandakan laju peningkatan efisiensi energi global',
                    'Meningkatkan kerjasama internasional untuk penelitian energi bersih',
                    'Memperluas infrastruktur dan meningkatkan teknologi energi modern',
                ],
                'rce_action'  => 'RCE Jawa Timur menjalankan proyek instalasi panel surya komunal di desa terpencil Madura dan Tapal Kuda, serta edukasi efisiensi energi di sekolah dan institusi.',
            ],
            [
                'number'      => 8,
                'title'       => 'Pekerjaan Layak dan Pertumbuhan Ekonomi',
                'description' => 'Meningkatkan pertumbuhan ekonomi yang inklusif dan berkelanjutan, tenaga kerja penuh dan produktif, serta pekerjaan yang layak untuk semua.',
                'targets'     => 12,
                'detail'      => 'SDG 8 menghubungkan pertumbuhan ekonomi dengan pekerjaan yang layak, produktivitas tenaga kerja, dan pengurangan pengangguran, sambil memastikan pertumbuhan tidak merusak lingkungan.',
                'points'      => [
                    'Mempertahankan pertumbuhan ekonomi per kapita yang berkelanjutan',
                    'Mencapai produktivitas ekonomi yang lebih tinggi melalui inovasi',
                    'Mendorong kebijakan pembangunan yang mendukung usaha produktif',
                    'Mencapai pekerjaan penuh dan produktif serta pekerjaan layak bagi semua',
                    'Melindungi hak-hak buruh dan mendorong lingkungan kerja yang aman',
                ],
                'rce_action'  => 'RCE Jawa Timur mendukung pengembangan green economy melalui pelatihan keterampilan hijau, kewirausahaan sosial, dan kemitraan dengan sektor swasta yang bertanggung jawab.',
            ],
            [
                'number'      => 9,
                'title'       => 'Industri, Inovasi dan Infrastruktur',
                'description' => 'Membangun infrastruktur yang tangguh, meningkatkan industri inklusif dan berkelanjutan, serta mendorong inovasi.',
                'targets'     => 8,
                'detail'      => 'SDG 9 menekankan pentingnya infrastruktur berkualitas, industrialisasi yang inklusif dan berkelanjutan, serta investasi dalam riset dan inovasi sebagai fondasi pembangunan.',
                'points'      => [
                    'Mengembangkan infrastruktur berkualitas, andal, berkelanjutan, dan tangguh',
                    'Mendorong industrialisasi yang inklusif dan berkelanjutan',
                    'Meningkatkan akses usaha kecil terhadap layanan keuangan',
                    'Meningkatkan penelitian dan mendorong kemampuan teknologi sektor industri',
                    'Memfasilitasi pengembangan infrastruktur berkelanjutan di negara berkembang',
                ],
                'rce_action'  => 'RCE Jawa Timur bekerja sama dengan ITS dan universitas teknik di Jawa Timur untuk mengembangkan teknologi tepat guna yang berkelanjutan bagi komunitas lokal.',
            ],
            [
                'number'      => 10,
                'title'       => 'Berkurangnya Kesenjangan',
                'description' => 'Mengurangi kesenjangan di dalam dan antar negara.',
                'targets'     => 10,
                'detail'      => 'SDG 10 bertujuan untuk mengurangi ketimpangan pendapatan, mempromosikan inklusi sosial, ekonomi, dan politik bagi semua, serta memastikan kesempatan yang setara.',
                'points'      => [
                    'Mencapai dan mempertahankan pertumbuhan pendapatan 40% populasi terbawah',
                    'Memberdayakan dan meningkatkan inklusi sosial, ekonomi, dan politik semua orang',
                    'Menjamin kesempatan yang sama dan mengurangi kesenjangan hasil',
                    'Mengadopsi kebijakan fiskal dan sosial yang progresif',
                    'Meningkatkan representasi negara berkembang dalam lembaga internasional',
                ],
                'rce_action'  => 'RCE Jawa Timur mendorong akses pendidikan berkualitas bagi kelompok marginal, termasuk komunitas adat, penyandang disabilitas, dan masyarakat pedesaan terpencil.',
            ],
            [
                'number'      => 11,
                'title'       => 'Kota dan Komunitas Berkelanjutan',
                'description' => 'Menjadikan kota dan permukiman inklusif, aman, tangguh, dan berkelanjutan.',
                'targets'     => 10,
                'detail'      => 'SDG 11 berfokus pada pembangunan perkotaan yang inklusif dan berkelanjutan, termasuk perumahan yang layak, transportasi publik, ruang hijau, serta pengurangan risiko bencana.',
                'points'      => [
                    'Menjamin akses semua orang terhadap perumahan yang layak dan terjangkau',
                    'Menyediakan akses terhadap sistem transportasi yang aman dan terjangkau',
                    'Meningkatkan urbanisasi yang inklusif dan berkelanjutan',
                    'Melindungi warisan budaya dan alam dunia',
                    'Mengurangi dampak buruk bencana terhadap kota dan permukiman',
                ],
                'rce_action'  => 'RCE Jawa Timur aktif dalam program kota berkelanjutan di Surabaya, Malang, dan Banyuwangi, mencakup tata ruang hijau, transportasi publik, dan mitigasi bencana perkotaan.',
            ],
            [
                'number'      => 12,
                'title'       => 'Konsumsi dan Produksi yang Bertanggung Jawab',
                'description' => 'Menjamin pola produksi dan konsumsi yang berkelanjutan.',
                'targets'     => 11,
                'detail'      => 'SDG 12 mendorong efisiensi penggunaan sumber daya alam, pengurangan limbah, dan pergeseran menuju pola konsumsi dan produksi yang lebih berkelanjutan di semua tingkatan.',
                'points'      => [
                    'Melaksanakan Program Konsumsi dan Produksi Berkelanjutan 10 Tahun',
                    'Mencapai pengelolaan berkelanjutan dan efisiensi penggunaan sumber daya alam',
                    'Mengurangi separuh limbah pangan per kapita global',
                    'Pengelolaan bahan kimia dan semua limbah secara bertanggung jawab',
                    'Mendorong perusahaan mengadopsi praktik berkelanjutan',
                ],
                'rce_action'  => 'RCE Jawa Timur menjalankan program bank sampah, daur ulang komunitas, dan edukasi konsumsi berkelanjutan di sekolah dan masyarakat di berbagai wilayah Jawa Timur.',
            ],
            [
                'number'      => 13,
                'title'       => 'Penanganan Perubahan Iklim',
                'description' => 'Mengambil tindakan cepat untuk mengatasi perubahan iklim dan dampaknya.',
                'targets'     => 5,
                'detail'      => 'SDG 13 menyerukan tindakan segera untuk memerangi perubahan iklim dan dampaknya, termasuk memperkuat ketahanan dan kemampuan adaptasi terhadap bahaya iklim.',
                'points'      => [
                    'Memperkuat ketahanan dan kemampuan adaptasi terhadap bahaya iklim',
                    'Mengintegrasikan tindakan perubahan iklim ke dalam kebijakan dan perencanaan',
                    'Meningkatkan pendidikan dan kesadaran perubahan iklim',
                    'Memenuhi komitmen UNFCCC negara maju',
                    'Mendorong mekanisme peningkatan kapasitas adaptasi iklim',
                ],
                'rce_action'  => 'RCE Jawa Timur mengembangkan kurikulum perubahan iklim untuk pendidikan formal dan non-formal, serta mendampingi komunitas pesisir dalam adaptasi terhadap kenaikan permukaan laut.',
            ],
            [
                'number'      => 14,
                'title'       => 'Ekosistem Lautan',
                'description' => 'Melestarikan dan memanfaatkan secara berkelanjutan sumber daya kelautan dan samudra untuk pembangunan berkelanjutan.',
                'targets'     => 10,
                'detail'      => 'SDG 14 berfokus pada pencegahan polusi laut, perlindungan ekosistem laut dan pesisir, pengaturan penangkapan ikan yang berkelanjutan, dan konservasi kawasan laut.',
                'points'      => [
                    'Mencegah dan mengurangi polusi laut dari kegiatan di darat',
                    'Mengelola dan melindungi ekosistem laut dan pesisir secara berkelanjutan',
                    'Meminimalkan dampak pengasaman laut',
                    'Mengatur panen ikan dan mengakhiri penangkapan ikan berlebihan',
                    'Melarang subsidi perikanan yang berkontribusi pada penangkapan berlebih',
                ],
                'rce_action'  => 'RCE Jawa Timur menjalankan program pemulihan mangrove di pesisir Gresik-Sidoarjo dan edukasi konservasi terumbu karang bersama komunitas nelayan Madura.',
            ],
            [
                'number'      => 15,
                'title'       => 'Ekosistem Daratan',
                'description' => 'Melindungi, merestorasi, dan meningkatkan pemanfaatan berkelanjutan ekosistem daratan.',
                'targets'     => 12,
                'detail'      => 'SDG 15 mencakup perlindungan hutan, lahan basah, pegunungan, dan lahan kering, serta menghentikan kehilangan keanekaragaman hayati dan degradasi lahan.',
                'points'      => [
                    'Menjamin pelestarian, restorasi, dan pemanfaatan berkelanjutan ekosistem darat',
                    'Mendorong pengelolaan hutan berkelanjutan dan menghentikan deforestasi',
                    'Menanggulangi desertifikasi dan merestorasi tanah yang terdegradasi',
                    'Menjamin pelestarian ekosistem pegunungan',
                    'Mengambil tindakan segera untuk mengurangi degradasi habitat alami',
                ],
                'rce_action'  => 'RCE Jawa Timur berkolaborasi dalam program penghijauan lereng Gunung Bromo-Tengger-Semeru, restorasi lahan gambut, dan edukasi keanekaragaman hayati lokal.',
            ],
            [
                'number'      => 16,
                'title'       => 'Perdamaian, Keadilan dan Kelembagaan yang Tangguh',
                'description' => 'Menguatkan masyarakat yang inklusif dan damai untuk pembangunan berkelanjutan.',
                'targets'     => 12,
                'detail'      => 'SDG 16 bertujuan untuk mempromosikan masyarakat yang damai dan inklusif, menjamin akses keadilan bagi semua, serta membangun institusi yang efektif, akuntabel, dan inklusif.',
                'points'      => [
                    'Mengurangi segala bentuk kekerasan secara signifikan',
                    'Mengakhiri pelecehan, eksploitasi, perdagangan, dan kekerasan terhadap anak',
                    'Mendorong supremasi hukum dan menjamin akses keadilan yang setara',
                    'Mengurangi arus keuangan gelap dan senjata secara substansial',
                    'Mengembangkan lembaga yang efektif, akuntabel, dan transparan',
                ],
                'rce_action'  => 'RCE Jawa Timur mendukung pendidikan perdamaian, resolusi konflik berbasis komunitas, dan penguatan tata kelola lokal melalui kemitraan dengan pemerintah daerah.',
            ],
            [
                'number'      => 17,
                'title'       => 'Kemitraan untuk Mencapai Tujuan',
                'description' => 'Menguatkan sarana pelaksanaan dan merevitalisasi kemitraan global untuk pembangunan berkelanjutan.',
                'targets'     => 19,
                'detail'      => 'SDG 17 adalah landasan dari seluruh agenda 2030. Tanpa kemitraan yang kuat antara pemerintah, sektor swasta, dan masyarakat sipil, 16 tujuan lainnya tidak akan bisa dicapai.',
                'points'      => [
                    'Memperkuat mobilisasi sumber daya domestik termasuk dukungan internasional',
                    'Mendorong negara maju memenuhi komitmen bantuan pembangunan resmi',
                    'Memobilisasi sumber daya keuangan tambahan untuk negara berkembang',
                    'Meningkatkan transfer teknologi ramah lingkungan',
                    'Meningkatkan kemitraan multi-pemangku kepentingan global untuk pembangunan berkelanjutan',
                ],
                'rce_action'  => 'Kemitraan adalah DNA RCE Jawa Timur. Kami menghubungkan universitas, pemerintah, LSM, komunitas, dan sektor swasta dalam jaringan aksi nyata untuk SDGs di Jawa Timur.',
            ],
        ];
    }

    public function index()
    {
        $sdgs = $this->getSdgs();
        return view('sdg.index', compact('sdgs'));
    }

    public function show(int $number)
    {
        $sdgs = $this->getSdgs();
        $sdg = collect($sdgs)->firstWhere('number', $number);

        if (!$sdg) {
            abort(404);
        }

        $prev = collect($sdgs)->firstWhere('number', $number - 1);
        $next = collect($sdgs)->firstWhere('number', $number + 1);

        return view('sdg.show', compact('sdg', 'prev', 'next', 'sdgs'));
    }
}
