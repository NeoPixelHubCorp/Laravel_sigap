<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Complain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
    {
        $categories = Category::all(); // Mengambil semua kategori yang sudah ada

        $complains = [
            [
                'title'       => 'Kerusakan Jalan Raya',
                'description' => 'Jalan raya utama di daerah kami rusak parah dan sering menyebabkan kecelakaan.',
                'image'       => null,
                'latitude'    => -6.2088,
                'longitude'   => 106.8456,
                'address'     => 'Jl. Raya No. 1, Jakarta',
                'city'        => 'Jakarta',
                'district'    => 'Central Jakarta',
                'category_id' => $categories->where('name', 'Infrastruktur')->first()->id,
                'user_id'     => 1,
            ],
            [
                'title'       => 'Pelayanan Kesehatan Tidak Memadai',
                'description' => 'Fasilitas kesehatan di daerah kami kekurangan tenaga medis dan peralatan.',
                'image'       => null,
                'latitude'    => -6.2210,
                'longitude'   => 106.8440,
                'address'     => 'Jl. Sehat No. 3, Jakarta',
                'city'        => 'Jakarta',
                'district'    => 'East Jakarta',
                'category_id' => $categories->where('name', 'Kesehatan')->first()->id,
                'user_id'     => 1,
            ],
            [
                'title'       => 'Sampah Tidak Terkelola dengan Baik',
                'description' => 'Setiap hari, sampah menumpuk di sepanjang jalan dan tidak ada petugas yang membersihkan.',
                'image'       => null,
                'latitude'    => -6.2083,
                'longitude'   => 106.8412,
                'address'     => 'Jl. Bersih No. 5, Jakarta',
                'city'        => 'Jakarta',
                'district'    => 'West Jakarta',
                'category_id' => $categories->where('name', 'Sampah & Kebersihan')->first()->id,
                'user_id'     => 2,
            ],
            [
                'title'       => 'Pemadaman Listrik Berkepanjangan',
                'description' => 'Sering terjadi pemadaman listrik di wilayah kami tanpa pemberitahuan yang jelas.',
                'image'       => null,
                'latitude'    => -6.2140,
                'longitude'   => 106.8450,
                'address'     => 'Jl. Energi No. 4, Jakarta',
                'city'        => 'Jakarta',
                'district'    => 'South Jakarta',
                'category_id' => $categories->where('name', 'Pemadaman Listrik')->first()->id,
                'user_id'     => 3,
            ],
            [
                'title'       => 'Kualitas Udara yang Buruk',
                'description' => 'Kualitas udara di daerah kami buruk dan sering menyebabkan gangguan pernapasan.',
                'image'       => null,
                'latitude'    => -6.1990,
                'longitude'   => 106.8540,
                'address'     => 'Jl. Alam No. 6, Jakarta',
                'city'        => 'Jakarta',
                'district'    => 'North Jakarta',
                'category_id' => $categories->where('name', 'Lingkungan')->first()->id,
                'user_id'     => 2,
            ],
        ];

        // Insert semua data complain menggunakan Eloquent
        foreach ($complains as $complain) {
            Complain::create($complain);
        }
    }
}

