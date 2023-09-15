<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    // ระบุคอลัมน์ที่สามารถใช้งานแบบ Mass Assignment
    protected $fillable = [
        'course_name',
        'course_content',
        'location',
        'course_type',
        'number_of_students',
        'teaching_days',
        'teaching_times',
        'course_price',
        'message_to_students',
        'course_status',
        'payment_receipt',
        // เพิ่มคอลัมน์อื่นๆ ที่คุณต้องการบันทึกได้ที่นี่
    ];
}
