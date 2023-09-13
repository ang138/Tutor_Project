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
            ];

            foreach ($user as $key => $value) {
                User::create($value);
            }
    }
}
