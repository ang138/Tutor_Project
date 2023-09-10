<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = [
            // ----คณะวิทยาศาสตร์----
            ['major_name' => 'คณิตศาสตร์', 'faculty_id' => 1],
            ['major_name' => 'เคมี', 'faculty_id' => 1],
            ['major_name' => 'ชีววิทยา', 'faculty_id' => 1],
            ['major_name' => 'จุลชีววิทยา', 'faculty_id' => 1],
            ['major_name' => 'ฟิสิกส์วัสดุและนาโนเทคโนโลยี ', 'faculty_id' => 1],
            ['major_name' => 'วิทยาการคอมพิวเตอร์', 'faculty_id' => 1],
            ['major_name' => 'เทคโนโลยีสารสนเทศ', 'faculty_id' => 1],
            ['major_name' => 'วิทยาศาสตร์สิ่งแวดล้อม ', 'faculty_id' => 1],
            ['major_name' => 'วิทยาศาสตร์การประมงและทรัพยากรทางน้ำ', 'faculty_id' => 1],

            // ----คณะวิทยาการสุขภาพและการกีฬา----
            ['major_name' => 'สาธารณสุขชุมชน', 'faculty_id' => 2],
            ['major_name' => 'อาชีวอนามัยและความปลอดภัย', 'faculty_id' => 2],
            ['major_name' => 'วิทยาศาสตร์การกีฬา', 'faculty_id' => 2],
            ['major_name' => 'การแพทย์แผนไทย', 'faculty_id' => 2],
            ['major_name' => 'สาธารณสุขศาสตร์ ', 'faculty_id' => 2],

            // ----คณะเทคโนโลยีและการพัฒนาชุมชน----
            ['major_name' => 'สัตวศาสตร์', 'faculty_id' => 3],
            ['major_name' => 'ส่งเสริมการเกษตรและพัฒนาชุมชน', 'faculty_id' => 3],
            ['major_name' => 'เทคโนโลยีและนวัตกรรมการผลิตพื', 'faculty_id' => 3],

            // ----คณะวิศวกรรมศาสตร์----
            ['major_name' => 'วิศวกรรมเมคคาทรอนิกส์', 'faculty_id' => 4],
            ['major_name' => 'วิศวกรรมยางและพอลิเมอร์', 'faculty_id' => 4],
            ['major_name' => 'วิศวกรรมเครื่องกล', 'faculty_id' => 4],

            // ----คณะพยาบาลศาสตร์----
            ['major_name' => 'พยาบาลศาสตร์', 'faculty_id' => 5],

            // ----คณะนิติศาสตร์----
            ['major_name' => 'คณะนิติศาสตร์', 'faculty_id' => 6],

            // ----คณะอุตสาหกรรมเกษตรและชีวภาพ----
            ['major_name' => 'วิทยาศาสตร์และเทคโนโลยีอาหาร', 'faculty_id' => 7],
            ['major_name' => 'เทคโนโลยีเครื่องสำอางและผลิตภัณฑ์เสริมอาหาร', 'faculty_id' => 7],

            // ----คณะศึกษาศาสตร์ ----
            ['major_name' => 'เทคโนโลยีและสื่อสารการศึกษา', 'faculty_id' => 8],
            ['major_name' => 'การประเมินผลและวิจัย', 'faculty_id' => 8],
            ['major_name' => 'หลักสูตรและการสอน', 'faculty_id' => 8],
            ['major_name' => 'การบริหารการศึกษา', 'faculty_id' => 8],
            ['major_name' => 'พลศึกษาและสุขศึกษา', 'faculty_id' => 8],
            ['major_name' => 'จิตวิทยา', 'faculty_id' => 8],
            ['major_name' => 'การสอนวิทยาศาสตร์และคณิตศาสตร์', 'faculty_id' => 8],
            ['major_name' => 'การสอนศิลปศาสตร์', 'faculty_id' => 8],

        ];

        DB::table('majors')->insert($majors);
    }
}
