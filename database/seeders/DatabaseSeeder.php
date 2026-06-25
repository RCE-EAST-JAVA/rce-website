<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Dummy
        User::create([
            'name' => 'Admin RCE East Java',
            'email' => 'admin@rce-eastjava.org',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User RCE East Java',
            'email' => 'user@rce-eastjava.org',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // 2. Data Dummy Proyek
        \App\Models\Project::create([
            'title' => 'Workshop Pengelolaan Sampah Organik Berbasis Komunitas',
            'description' => 'Edukasi dan pelatihan pengolahan sampah organik rumah tangga menjadi pupuk kompos di pemukiman padat penduduk Jawa Timur.',
            'category' => 'Sampah',
            'status' => 'Selesai',
            'image' => 'project1.jpg',
            'sdgs' => 'SDG 12, SDG 13',
            'author' => 'Dr. H. Ahmad Yani, M.T.',
            'date' => '12 Jan 2026',
        ]);

        \App\Models\Project::create([
            'title' => 'Penanaman Bakau di Sungai Brantas',
            'description' => 'Inisiatif pemulihan ekosistem pesisir melalui penanaman bibit bakau bersama komunitas dan mahasiswa se-Jawa Timur.',
            'category' => 'Air',
            'status' => 'Aktif',
            'image' => 'project2.jpg',
            'sdgs' => 'SDG 14, SDG 15',
            'author' => 'Dr. Shinta Rahayu, M.Si.',
            'date' => '24 Feb 2026',
        ]);

        \App\Models\Project::create([
            'title' => 'Penerapan Panel Surya untuk Perumahan Rakyat',
            'description' => 'Instalasi panel surya skala mikro untuk mendukung kebutuhan listrik ramah lingkungan di desa tertinggal.',
            'category' => 'Energi',
            'status' => 'Aktif',
            'image' => 'project3.jpg',
            'sdgs' => 'SDG 7, SDG 11',
            'author' => 'Ali Solihin, M.T.',
            'date' => '02 Mar 2026',
        ]);

        // 3. Data Dummy Staf
        \App\Models\Staff::create([
            'name' => 'Dr. H. Ahmad Yani, M.T.',
            'role' => 'Koordinator Bidang Energi',
            'affiliation' => 'Institut Teknologi Sepuluh Nopember',
            'expertise' => 'Eco-design, Energi Terbarukan',
            'image' => 'staff1.jpg',
            'email' => 'ahmad.yani@rce-eastjava.org',
            'linkedin' => 'linkedin.com/in/ahmadyani',
        ]);

        \App\Models\Staff::create([
            'name' => 'Dr. Shinta Rahayu, M.Si.',
            'role' => 'Koordinator Lingkungan Hidup',
            'affiliation' => 'Universitas Negeri Surabaya',
            'expertise' => 'Ekologi Air, Konservasi Mangrove',
            'image' => 'staff2.jpg',
            'email' => 'shinta.r@rce-eastjava.org',
            'linkedin' => 'linkedin.com/in/shintarahayu',
        ]);

        \App\Models\Staff::create([
            'name' => 'Ali Solihin, M.T.',
            'role' => 'Peneliti Teknologi Tepat Guna',
            'affiliation' => 'Universitas Brawijaya',
            'expertise' => 'Energi Terbarukan, Panel Surya',
            'image' => 'staff3.jpg',
            'email' => 'ali.solihin@rce-eastjava.org',
            'linkedin' => 'linkedin.com/in/alisolihin',
        ]);

        \App\Models\Staff::create([
            'name' => 'Dr. Aliyah Purnamasari, M.Hum.',
            'role' => 'Koordinator Edukasi Publik',
            'affiliation' => 'Universitas Airlangga',
            'expertise' => 'Pendidikan Lingkungan, Sosiologi Komunitas',
            'image' => 'staff4.jpg',
            'email' => 'aliyah.p@rce-eastjava.org',
            'linkedin' => 'linkedin.com/in/aliyahp',
        ]);
    }
}
