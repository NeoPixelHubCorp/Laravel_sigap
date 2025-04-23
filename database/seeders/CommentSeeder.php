<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            'id' => 1,
            'complains_id' => 1,
            'parent_id' => null,
            'user_id' => 1,
            'comment' => 'Komentar ini udah diedit yaa~',
            'created_at' => '2025-04-22 14:44:41',
            'updated_at' => '2025-04-22 14:46:17',
        ]);

        // Balasan ke komentar ID 1
        DB::table('comments')->insert([
            'id' => 2,
            'complains_id' => 1,
            'parent_id' => 1,
            'user_id' => 1,
            'comment' => 'Balasan ke komentar ID 1',
            'created_at' => '2025-04-22 14:45:16',
            'updated_at' => '2025-04-22 14:45:16',
        ]);
    }
}
