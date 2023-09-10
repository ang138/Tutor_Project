<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function getFaculties()
{
    $faculties = Faculty::all();
    return response()->json($faculties);
}

public function getMajors($facultyId)
{
    $majors = Major::where('faculty', $facultyId)->get();
    return response()->json($majors);
}
}
