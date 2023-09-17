<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';

    protected $fillable = [
        'subject_id ',
        'subject_name',
        // เพิ่มคอลัมน์อื่นๆ ที่คุณต้องการบันทึกได้ที่นี่
    ];
}
