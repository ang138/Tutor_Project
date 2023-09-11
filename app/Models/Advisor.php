<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $table = 'advisors'; // ชื่อตารางในฐานข้อมูล

    protected $fillable = [
        'advisor_id',
        'advisor_name',
        'advisor_surname',
        'advisor_email',
        'advisor_password',
        'advisor_status',
        'advisor_faculty',
        'advisor_major',
        // เพิ่มฟิลด์อื่นๆ ตามต้องการ
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'advisor_faculty', 'id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'advisor_major', 'id');
    }
}
