<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        DB::table('complains')->insert([
            [
                'user_id' => 1,
                'category_id' => 1,
                'no_aduan' => 'ADUAN-68031EB223B59',
                'title' => 'Lampu Jalan Rusak di Taman Kota',
                'description' => 'Lampu jalan di taman kota sudah lama mati dan membahayakan pengguna jalan.',
                'image' => null,
                'location' => 'Taman Kota, Jalan Raya No. 12',
                'status' => 'pending',
                'visibility' => 'private',
                'tanggal_aduan' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 2,
                'no_aduan' => 'ADUAN-68031FD041C13',
                'title' => 'Sampah Berserakan di Taman Kota',
                'description' => 'Tumpukan sampah semakin parah dan menimbulkan bau tidak sedap.',
                'image' => null,
                'location' => 'Taman Kota, Blok C',
                'status' => 'dalam_penanganan',
                'visibility' => 'private',
                'tanggal_aduan' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 3,
                'no_aduan' => 'ADUAN-68031FDE8D3E1',
                'title' => 'Sampah Menumpuk di Tepi Sungai',
                'description' => 'Sampah plastik menumpuk di sepanjang tepi sungai, mengganggu pemandangan dan lingkungan.',
                'image' => null,
                'location' => 'Sungai Cisadane, Kelurahan Ciledug',
                'status' => 'selesai',
                'visibility' => 'private',
                'tanggal_aduan' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 4,
                'no_aduan' => 'ADUAN-68031FEC3C141',
                'title' => 'Antrian Panjang di Kantor Pelayanan Publik',
                'description' => 'Proses layanan yang sangat lambat di kantor pelayanan publik menyebabkan antrian panjang dan ketidaknyamanan warga.',
                'image' => null,
                'location' => 'Kantor Pelayanan Publik, Jalan Raya No. 45',
                'status' => 'diverifikasi',
                'visibility' => 'private',
                'tanggal_aduan' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 5,
                'no_aduan' => 'ADUAN-68031FF95F174',
                'title' => 'Pelanggaran Lalu Lintas di Jalan Raya No. 10',
                'description' => 'Pengendara motor melanggar rambu lalu lintas dan berjalan melawan arah, membahayakan keselamatan pengguna jalan lainnya.',
                'image' => null,
                'location' => 'Jalan Raya No. 10, Kota Baru',
                'status' => 'diteruskan_ke_instansi',
                'visibility' => 'public',
                'tanggal_aduan' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'no_aduan' => 'ADUAN-6804C17F9F58E',
                'title' => 'Kebocoran Pipa Air di Jalan Raya',
                'description' => 'Terjadi kebocoran pipa air di sepanjang jalan raya, menyebabkan gangguan aliran air di sekitar kawasan tersebut.',
                'image' => '01JS997PM9DP6N370TEE0R3PPP.jpeg',
                'location' => 'Jalan Raya No. 45, Kelurahan A',
                'status' => 'diteruskan_ke_instansi',
                'visibility' => 'private',
                'tanggal_aduan' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 5,
                'no_aduan' => 'ADUAN-6804C6DA1B4AC',
                'title' => 'Pengendara Motor Melawan Arah di Jalan Raya',
                'description' => 'Seorang pengendara motor melawan arah di jalan raya, hampir menabrak mobil yang melintas.',
                'image' => '01JS9AHGZGB4GV8R23ZQW68CZY.jpeg',
                'location' => 'Jalan Raya No. 13, Kelurahan C',
                'status' => 'dalam_penanganan',
                'visibility' => 'private',
                'tanggal_aduan' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
