<?php

namespace Database\Seeders;

use App\Models\Response;
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
        $responses = [
            [
                'admin_id'    => 1,
                'complain_id' => 1,
                'response'    => 'Aduan telah kami verifikasi dan akan ditindaklanjuti.',
                'updated_by'  => 1,
            ],
            [
                'admin_id'    => 1,
                'complain_id' => 2,
                'response'    => 'Aduan telah kami teruskan ke instansi terkait.',
                'updated_by'  => 1,
            ],
            [
                'admin_id'    => 1,
                'complain_id' => 3,
                'response'    => 'Aduan sedang dalam penanganan petugas di lapangan.',
                'updated_by'  => 1,
            ],
            [
                'admin_id'    => 1,
                'complain_id' => 4,
                'response'    => 'Permasalahan telah diselesaikan. Terima kasih atas laporannya.',
                'updated_by'  => 1,
            ],
            [
                'admin_id'    => 1,
                'complain_id' => 5,
                'response'    => 'Mohon maaf, aduan tidak dapat diproses karena kurangnya bukti yang mendukung.',
                'updated_by'  => 1,
            ],
        ];

        foreach ($responses as $response) {
            Response::create($response);
        }
    }

}
