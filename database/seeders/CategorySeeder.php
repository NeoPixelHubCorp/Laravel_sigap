<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Infrastruktur'],
            ['name' => 'Pelayanan Publik'],
            ['name' => 'Lingkungan'],
            ['name' => 'Keamanan'],
            ['name' => 'Kesehatan'],
            ['name' => 'Pendidikan'],
            ['name' => 'Transportasi'],
            ['name' => 'Administrasi Kependudukan'],
            ['name' => 'Pencemaran Suara / Polusi'],
            ['name' => 'Sosial & Kesejahteraan'],
            ['name' => 'Pajak dan Retribusi'],
            ['name' => 'Perizinan Usaha'],
            ['name' => 'Sampah & Kebersihan'],
            ['name' => 'Bencana Alam'],
            ['name' => 'Pemadaman Listrik'],
            ['name' => 'Akses Internet / Telekomunikasi'],
            ['name' => 'Korupsi / Penyalahgunaan Wewenang'],
            ['name' => 'Pungutan Liar'],
            ['name' => 'Kekerasan Rumah Tangga / Sosial'],
            ['name' => 'Ketersediaan Air Bersih'],
            ['name' => 'Ketersediaan Pangan'],
            ['name' => 'Pengendalian Penyakit'],
            ['name' => 'Pengelolaan Sumber Daya Alam'],
            ['name' => 'Keterbatasan Akses Keuangan'],
            ['name' => 'Pemanfaatan Teknologi'],
            ['name' => 'Pengelolaan Air Limbah'],
            ['name' => 'Rehabilitasi Mental & Sosial'],
            ['name' => 'Perlindungan Anak & Perempuan'],
            ['name' => 'Sistem Pendaftaran Layanan Publik'],
            ['name' => 'Keterbatasan Fasilitas Olahraga & Rekreasi']
        ];

        DB::table('categories')->insert($categories);
    }
}
