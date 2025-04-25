<?php

namespace Database\Seeders;

use App\Models\AppRating;
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
        // Ambil semua pengguna dari tabel users
        $users = \App\Models\User::all();

        // Feedback yang akan digunakan secara acak
        $feedbacks = [
            'Aplikasi sangat membantu! Terima kasih!',
            'Kurang menarik, mungkin ada fitur tambahan.',
            'Rating 4 karena aplikasi berjalan lancar tapi ada beberapa bug.',
            'Sangat suka! Semoga semakin berkembang.',
            'Aplikasi cukup oke, tapi saya berharap ada pembaruan fitur.',
            'Terlalu sering crash, tidak nyaman digunakan.',
            'Aplikasi bagus, mudah digunakan.',
            'Lumayan, masih banyak yang perlu ditingkatkan.',
        ];

        // Mengisi rating dan feedback untuk setiap user
        foreach ($users as $user) {
            AppRating::create([
                'user_id' => $user->id,                   // ID user dari seeder UserSeeder
                'app_rating' => rand(1, 5),               // Rating acak dari 1 sampai 5
                'app_feedback' => $feedbacks[array_rand($feedbacks)], // Feedback acak dari array
            ]);
        }
    }
}
