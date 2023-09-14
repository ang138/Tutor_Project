<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advisors = [
            // ----คณะวิทยาศาสตร์----
            [
                'advisor_name'     => 'อาจารย์ กฤษณ์',
                'advisor_surname'  => 'ทองขุนดำ',
                'advisor_email'    => 'krit@tsu.ac.th',
                'advisor_password' => '1234',
                'advisor_status'   => 2,
                'advisor_faculty'  => 1,
                'advisor_major'    => 2,
            ],
            [
                'advisor_name'     => 'อาจารย์ ดร. คณิดา',
                'advisor_surname'  => 'สินใหม',
                'advisor_email'    => 'kanida@tsu.ac.th',
                'advisor_password' => '1234',
                'advisor_status'   => 2,
                'advisor_faculty'  => 1,
                'advisor_major'    => 2,
            ],
            [
                'advisor_name'     => 'ผศ. ดร. วิสิทธิ์',
                'advisor_surname'  => 'บุญชุม',
                'advisor_email'    => 'visit@tsu.ac.th',
                'advisor_password' => '1234',
                'advisor_status'   => 2,
                'advisor_faculty'  => 1,
                'advisor_major'    => 2,
            ],
            [
                'advisor_name'     => 'ผศ. ดร. สิรยา',
                'advisor_surname'  => 'สิทธิสาร',
                'advisor_email'    => 'siraya@tsu.ac.th',
                'advisor_password' => '1234',
                'advisor_status'   => 2,
                'advisor_faculty'  => 1,
                'advisor_major'    => 2,
            ],
            [
                'advisor_name'     => 'อาจารย์ ดร. สุวิมล',
                'advisor_surname'  => 'จุงจิตร์',
                'advisor_email'    => 'suwimol@tsu.ac.th',
                'advisor_password' => '1234',
                'advisor_status'   => 2,
                'advisor_faculty'  => 1,
                'advisor_major'    => 2,
            ],

        ];

        DB::table('advisors')->insert($advisors);
    }
}
