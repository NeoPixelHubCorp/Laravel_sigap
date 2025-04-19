<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(array(
            array(
                'name'=>'Admin Pai',
                'email'=>'AdminPai@gmail.com',
                'role'=>'admin',
                'password'=>bcrypt('123456')
            ),
            array(
                'name'=>'Admin Lika',
                'email'=>'AdminLika@gmail.com',
                'role'=>'admin',
                'password'=>bcrypt('123456')
            ),
            array(
                'name'=>'User Pai',
                'email'=>'UserPai@gmail.com',
                'role'=>'user',
                'password'=>bcrypt('123456')
            ),
            array(
                'name'=>'User Lika',
                'email'=>'UserLika@gmail.com',
                'role'=>'user',
                'password'=>bcrypt('123456')
            ),
            array(
                'name'=>'Agent Pai',
                'email'=>'AgentPai@gmail.com',
                'role'=>'agent',
                'password'=>bcrypt('123456')
            ),
            array(
                'name'=>'Agent Lika',
                'email'=>'AgentLika@gmail.com',
                'role'=>'agent',
                'password'=>bcrypt('123456')
            ),
            ));
    }
}
