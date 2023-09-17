<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollments';

    // ระบุคอลัมน์ที่สามารถใช้งานแบบ Mass Assignment
    protected $fillable = [
        'cus_id',
        'cus_name',
        'cus_surname',
        'cus_email',
        'cus_birthdate',
        'cus_tel',
        'cus_facebook',
        'cus_line',
        // เพิ่มคอลัมน์อื่นๆ ที่คุณต้องการบันทึกได้ที่นี่
    ];
}
