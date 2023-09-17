<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrollment_course extends Model
{
    use HasFactory;

    protected $table = 'enrollment_courses';

    // ระบุคอลัมน์ที่สามารถใช้งานแบบ Mass Assignment
    protected $fillable = [
        'cus_id',
        'course_email',
        'cus_bill',
        // เพิ่มคอลัมน์อื่นๆ ที่คุณต้องการบันทึกได้ที่นี่
    ];
}
