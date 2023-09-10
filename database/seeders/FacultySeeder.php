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
                'faculty_name' => 'คณะวิทยาศาสตร์',
            ],
            [
                'faculty_name' => 'คณะวิทยาการสุขภาพและการกีฬา',
            ],
            [
                'faculty_name' => 'คณะเทคโนโลยีและการพัฒนาชุมชน',
            ],
            [
                'faculty_name' => 'คณะวิศวกรรมศาสตร์',
            ],
            [
                'faculty_name' => 'คณะพยาบาลศาสตร์',
            ],
            [
                'faculty_name' => 'คณะนิติศาสตร์',
            ],
            [
                'faculty_name' => 'คณะอุตสาหกรรมเกษตรและชีวภาพ',
            ],
            [
                'faculty_name' => 'คณะศึกษาศาสตร์ ',
            ],
            ];

            DB::table('faculties')->insert($faculties);
    }
}
