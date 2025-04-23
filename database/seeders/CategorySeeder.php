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
        DB::table('categories')->insert([
            [
                'category' => 'Fasilitas Umum Rusak',
                'slug' => 'fasilitas-umum-rusak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Kebersihan Lingkungan',
                'slug' => 'kebersihan-lingkungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Sampah Berserakan',
                'slug' => 'sampah-berserakan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Pelayanan Publik Buruk',
                'slug' => 'pelayanan-publik-buruk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Pelanggaran Lalu Lintas',
                'slug' => 'pelanggaran-lalu-lintas',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
