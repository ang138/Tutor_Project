<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'students';
	public $timestamps = true;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'std_id ', 'std_name','std_surname', 'std_email','std_password ',
        'std_status','std_faculty', 'std_major','std_class','std_gpax', 'std_grade',
	];
}
