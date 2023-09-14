<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = [
            [
                'name' => 'แอดมิน',
                'email' => 'admin@admin.com',
                'status' => '1',
                'password' => bcrypt('1234'),
                'user_id' => '1'
            ],
            [
                'name' => 'อาจารย์ กฤษณ์',
                'email' => 'krit@tsu.ac.th',
                'status' => '2',
                'password' => bcrypt('1234'),
                'user_id' => '1'
            ],
            [
                'name' => 'อาจารย์ ดร. คณิดา',
                'email' => 'kanida@tsu.ac.th',
                'status' => '2',
                'password' => bcrypt('1234'),
                'user_id' => '2'
            ],
            [
                'name' => 'ผศ. ดร. วิสิทธิ์',
                'email' => 'visit@tsu.ac.th',
                'status' => '2',
                'password' => bcrypt('1234'),
                'user_id' => '3'
            ],
            [
                'name' => 'ผศ. ดร. สิรยา',
                'email' => 'siraya@tsu.ac.th',
                'status' => '2',
                'password' => bcrypt('1234'),
                'user_id' => '4'
            ],
            [
                'name' => 'อาจารย์ ดร. สุวิมล',
                'email' => 'suwimol@tsu.ac.th',
                'status' => '2',
                'password' => bcrypt('1234'),
                'user_id' => '5'
            ],
            ];

            foreach ($user as $key => $value) {
                User::create($value);
            }
    }
}
