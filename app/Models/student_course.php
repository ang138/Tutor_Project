<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_course extends Model
{
    use HasFactory;
    protected $table = 'student_courses';

    // ระบุคอลัมน์ที่สามารถใช้งานแบบ Mass Assignment
    protected $fillable = [
        'std_id',
        'course_id',
        // เพิ่มคอลัมน์อื่นๆ ที่คุณต้องการบันทึกได้ที่นี่
    ];
}
