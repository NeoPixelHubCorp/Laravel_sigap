<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('responses')->insert([
            [
                'complain_id' => 1,
                'admin_id' => 1,
                'response' => 'Lampu jalan di taman kota sudah diperbaiki, terima kasih atas laporannya.',
                'updated_by' => 1,
                'handled_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complain_id' => 3,
                'admin_id' => 1,
                'response' => 'Tumpukan sampah di Taman Kota telah dipindahkan dan area tersebut sudah dibersihkan. Terima kasih atas laporannya.',
                'updated_by' => 1,
                'handled_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complain_id' => 4,
                'admin_id' => 1,
                'response' => 'Pembersihan sampah di tepi Sungai Cisadane telah selesai sepenuhnya pada tanggal 18 April 2025. Kami juga telah menambahkan papan larangan buang sampah di lokasi tersebut..',
                'updated_by' => 1,
                'handled_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
