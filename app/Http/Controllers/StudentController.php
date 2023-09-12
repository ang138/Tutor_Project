<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

// ------------------------------จัดการข้อมูลนิสิต-------------------------------
    // ------------เพิ่มข้อมูลนิสิต--------------
    public function insertstdform()
    {
        $data['faculties'] = Faculty::all(["name", "id"]);

        return view('adminpages.addStudent', $data);
    }

    public function insertstd(Request $request)
    {
        // รับข้อมูลจากคำขอ HTTP
        // $std_id       = $request->input('std_id');
        // $std_name     = $request->input('std_name');
        // $std_surname  = $request->input('std_surname');
        // $std_email    = $request->input('std_email');
        // $std_password = $request->input('std_password');
        // $std_status   = $request->input('std_status');
        // $std_faculty  = $request->input('std_faculty');
        // $std_major    = $request->input('std_major');
        // $std_class    = $request->input('std_class');

        $birthdate = $request->input('birth_year') . '-' . $request->input('birth_month') . '-' . $request->input('birth_day');

        $request->validate([
            'std_id'       => 'required',
            'std_name'     => 'required',
            'std_surname'  => 'required',
            'std_email'    => 'required|email',
            'std_password' => 'required',
            'std_status'   => 'required',
            'std_faculty'  => 'required',
            'std_major'    => 'required',
            'std_class'    => 'required',
            'birth_day'    => 'required',
            'birth_month'  => 'required',
            'birth_year'   => 'required',
        ]);

        // เก็บข้อมูลเข้าฐานข้อมูล
        DB::table('students')->insert([
            'std_id'       => $request->input('std_id'),
            'std_name'     => $request->input('std_name'),
            'std_surname'  => $request->input('std_surname'),
            'std_email'    => $request->input('std_email'),
            'std_password' => $request->input('std_password'),
            'std_status'   => $request->input('std_status'),
            'std_faculty'  => $request->input('std_faculty'),
            'std_major'    => $request->input('std_major'),
            'std_class'    => $request->input('std_class'),
            'std_gpax'     => null,
            'birthdate'    => $birthdate, // Insert birthdate
        ]);

        return redirect('manageStudent')->with('success', 'เพิ่มข้อมูลนิสิตเรียบร้อยแล้ว');

    }

    // -----สิ้นสุดการเพิ่มข้อมูลนิสิต-----

    // ---------------อัปเดตข้อมูลนิสิต------------------

    public function editStudent($std_id)
    {
        // Retrieve the student data using the query builder
        $student = DB::table('students')->where('std_id', $std_id)->first();

        $faculties = Faculty::all();
        $majors    = Major::all();

        // Check if the student exists
        if (!$student)
        {
            // Handle the case where the student is not found (e.g., display an error message or redirect)
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Extract the birthdate into separate variables (day, month, year)
        list($birth_year, $birth_month, $birth_day) = explode('-', $student->birthdate);

        // Pass the student data to the view for editing, including birthdate variables

        return view('adminpages.editStudent', compact('student', 'faculties', 'majors', 'birth_year', 'birth_month', 'birth_day'));

    }

    public function updateStudent(Request $request, $std_id)
    {
        // Validate the incoming request data here

        // Use the query builder to update the student's information

        $birthdate = $request->input('birth_year') . '-' . $request->input('birth_month') . '-' . $request->input('birth_day');

        DB::table('students')
            ->where('std_id', $std_id)
            ->update([
                'std_id'       => $request->input('std_id'),
                'std_name'     => $request->input('std_name'),
                'std_surname'  => $request->input('std_surname'),
                'std_email'    => $request->input('std_email'),
                'std_password' => $request->input('std_password'),
                'std_status'   => $request->input('std_status'),
                'std_faculty'  => $request->input('std_faculty'),
                'std_major'    => $request->input('std_major'),
                'std_class'    => $request->input('std_class'),
                'std_gpax'     => $request->input('std_gpax'),

                // Update the birthdate
                'birthdate'    => $birthdate,

                // Add more fields to update as needed
            ]);

        return redirect('manageStudent')->with('success', 'แก้ไขข้อมูลนิสิตเรียบร้อยแล้ว');

    }
    // -----สิ้นสุดการอัปเดตข้อมูลนิสิต-----

    // ----------------การลบข้อมูลนิสิต-----------------

    public function deleteStudent($std_id)
    {
        // Delete the student record from the database
        DB::table('students')->where('std_id', $std_id)->delete();

        // Redirect to the "manageStudent" page with a success message

        return redirect()->route('manageStudent')->with('success', 'ลบข้อมูลนิสิตเรียบร้อยแล้ว');
    }

    // -----สิ้นสุดการลบข้อมูลนิสิต-----

    // -----แสดงข้อมูลนิสิต-----

    public function manageStudent()
    {

        // ดึงข้อมูลนักศึกษาจากฐานข้อมูล
        $students = DB::table('students')
            ->join('faculties', 'students.std_faculty', '=', 'faculties.id')
            ->join('majors', 'students.std_major', '=', 'majors.id')
            ->select('students.*', 'faculties.name as faculty_name', 'majors.name as major_name')
            ->get();

        return view('adminpages.manageStudent', ['students' => $students]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function tutorHome()
    {
        return view('tutorpages.tutorHome');
    }
    public function manageSubject()
    {
        return view('tutorpages.manageSubject');
    }
    public function enrollment()
    {
        return view('tutorpages.enrollment');
    }
}
