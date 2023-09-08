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
                'name' => 'อัง',
                'email' => 'tutor@tutor.com',
                'status' => '3',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'แอดมิน',
                'email' => 'admin1@admin.com',
                'status' => '1',
                'password' => bcrypt('1234')
            ],
            [
                'name' => 'อาจารย์',
                'email' => 'advisor@advisor.com',
                'status' => '2',
                'password' => bcrypt('1234')
            ],
            ];

            foreach ($user as $key => $value) {
                User::create($value);
            }
    }
}
