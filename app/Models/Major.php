<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{

    protected $tables = ['majors'];

    // Define a relationship with the Faculty model
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

}
