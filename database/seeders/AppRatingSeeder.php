<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('app_ratings')->insert([
            [
                'user_id' => 4,
                'app_rating' => 5,
                'app_feedback' => 'hmm bagus',
                'version' => 'v1.03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'app_rating' => 4,
                'app_feedback' => null,
                'version' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'app_rating' => 1,
                'app_feedback' => 'Tiap buka selalu force close. Tolong diperbaiki secepatnya.',
                'version' => 'v1.5.0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'app_rating' => 3,
                'app_feedback' => 'Lumayan. Ada beberapa fitur yang belum jalan tapi overall oke.',
                'version' => 'v1.8.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'app_rating' => 5,
                'app_feedback' => 'Aplikasinya sangat membantu dan user-friendly. Good job!',
                'version' => 'v1.2.3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
