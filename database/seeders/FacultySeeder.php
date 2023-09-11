<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            [
                'name' => 'คณะวิทยาศาสตร์',
            ],
            [
                'name' => 'คณะวิทยาการสุขภาพและการกีฬา',
            ],
            [
                'name' => 'คณะเทคโนโลยีและการพัฒนาชุมชน',
            ],
            [
                'name' => 'คณะวิศวกรรมศาสตร์',
            ],
            [
                'name' => 'คณะพยาบาลศาสตร์',
            ],
            [
                'name' => 'คณะนิติศาสตร์',
            ],
            [
                'name' => 'คณะอุตสาหกรรมเกษตรและชีวภาพ',
            ],
            [
                'name' => 'คณะศึกษาศาสตร์ ',
            ],
            ];

            DB::table('faculties')->insert($faculties);
    }
}
