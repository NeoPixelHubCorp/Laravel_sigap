<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplainRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('complains_ratings')->insert([
            [
                'complains_id' => 1,
                'user_id' => 4,
                'complain_rating' => 5,
                'complain_feedback' => 'hmm bagus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complains_id' => 1,
                'user_id' => 1,
                'complain_rating' => 4,
                'complain_feedback' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complains_id' => 1,
                'user_id' => 1,
                'complain_rating' => 1,
                'complain_feedback' => 'Tiap buka selalu force close. Tolong diperbaiki secepatnya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complains_id' => 1,
                'user_id' => 1,
                'complain_rating' => 3,
                'complain_feedback' => 'Lumayan. Ada beberapa fitur yang belum jalan tapi overall oke.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'complains_id' => 1,
                'user_id' => 1,
                'complain_rating' => 5,
                'complain_feedback' => 'Aplikasinya sangat membantu dan user-friendly. Good job!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
