<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    // ------------------------------จัดการข้อมูลนิสิต-------------------------------
    // ------------เพิ่มข้อมูลนิสิต--------------
    public function insertstdform()
    {
        return view('adminpages.addStudent');
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
            'std_gpax'     => null, // เก็บค่าว่างในฐานข้อมูล
            'std_grade' => null, // เก็บค่าว่างในฐานข้อมูล
        ]);

        return redirect('manageStudent')->with('success', 'เพิ่มข้อมูลนิสิตเรียบร้อยแล้ว');

    }

    // -----สิ้นสุดการเพิ่มข้อมูลนิสิต-----

    // ---------------อัปเดตข้อมูลนิสิต------------------

    public function editStudent($std_id)
    {
        // Retrieve the student data using the query builder
        $student = DB::table('students')->where('std_id', $std_id)->first();

        // Check if the student exists
        if (!$student)
        {
            // Handle the case where the student is not found (e.g., display an error message or redirect)
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Pass the student data to the view for editing

        return view('adminpages.editStudent', compact('student'));
    }

    public function updateStudent(Request $request, $std_id)
    {
        // Validate the incoming request data here

        // Use the query builder to update the student's information
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
                'std_grade'    => $request->input('std_grade'),

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

    // ------------------------------จัดการข้อมูลอาจารย์ที่ปรึกษา-------------------------------
    // ------------เพิ่มข้อมูลอาจารย์--------------
    public function insertadvisorform()
    {
        $faculties = Faculty::all();

        return view('adminpages.addAdvisor', compact('faculties'));
    }
    public function getMajors(Request $request, $facultyId)
{
    // Assuming you have a 'majors' table with 'id', 'faculty_id', and 'major_name' columns
    $majors = Major::where('faculty', $facultyId)->get();
    return response()->json($majors);
}

    public function insertadvisor(Request $request)
    {
        $request->validate([
            'advisor_id'       => 'required',
            'advisor_name'     => 'required',
            'advisor_surname'  => 'required',
            'advisor_email'    => 'required|email',
            'advisor_password' => 'required',
            'advisor_status'   => 'required',
            'advisor_faculty'  => 'required',
            'advisor_major'    => 'required',
        ]);

        DB::table('advisors')->insert([
            'advisor_id'       => $request->input('advisor_id'),
            'advisor_name'     => $request->input('advisor_name'),
            'advisor_surname'  => $request->input('advisor_surname'),
            'advisor_email'    => $request->input('advisor_email'),
            'advisor_password' => $request->input('advisor_password'),
            'advisor_status'   => $request->input('advisor_status'),
            'advisor_faculty'  => $request->input('advisor_faculty'),
            'advisor_major'    => $request->input('advisor_major'),
        ]);

        return redirect('manageAdvisor')->with('success', 'เพิ่มข้อมูลอาจารย์เรียบร้อยแล้ว');
    }
    // -----สิ้นสุดการเพิ่มข้อมูลอาจารย์-----

    // ---------------อัปเดตข้อมูลอาจารย์------------------
    public function editAdvisor($advisor_id)
    {
        // Retrieve the student data using the query builder
        $advisor = DB::table('advisors')->where('advisor_id', $advisor_id)->first();

        // Check if the student exists
        if (!$advisor)
        {
            // Handle the case where the student is not found (e.g., display an error message or redirect)
            return redirect()->back()->with('error', 'Advisor not found.');
        }

        // Pass the student data to the view for editing

        return view('adminpages.editAdvisor', compact('advisor'));
    }

    public function updateAdvisor(Request $request, $advisor_id)
    {
        // Validate the incoming request data here

        // Use the query builder to update the student's information
        DB::table('advisors')
            ->where('advisor_id', $advisor_id)
            ->update([
                'advisor_id'       => $request->input('advisor_id'),
                'advisor_name'     => $request->input('advisor_name'),
                'advisor_surname'  => $request->input('advisor_surname'),
                'advisor_email'    => $request->input('advisor_email'),
                'advisor_password' => $request->input('advisor_password'),
                'advisor_status'   => $request->input('advisor_status'),
                'advisor_faculty'  => $request->input('advisor_faculty'),
                'advisor_major'    => $request->input('advisor_major'),

                // Add more fields to update as needed
            ]);

        return redirect('manageAdvisor')->with('success', 'แก้ไขข้อมูลอาจารย์เรียบร้อยแล้ว');

    }
    // -----สิ้นสุดการอัปเดตข้อมูลอาจารย์-----

    public function deleteAdvisor($advisor_id)
    {
        // Delete the student record from the database
        DB::table('advisors')->where('advisor_id', $advisor_id)->delete();

        // Redirect to the "manageStudent" page with a success message

        return redirect()->route('manageAdvisor')->with('success', 'ลบข้อมูลอาจารย์เรียบร้อยแล้ว');
    }

    // -----สิ้นสุดการลบข้อมูลนิสิต-----

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function adminHome()
    {
        return view('adminpages.adminHome');
    }

    // -----แสดงข้อมูลนิสิต-----

    public function manageStudent()
    {

        // ดึงข้อมูลนักศึกษาจากฐานข้อมูล
        $students = DB::table('students')->get();

        return view('adminpages.manageStudent', ['students' => $students]);
    }

    // -----แสดงข้อมูลอาจารย์-----

    public function manageAdvisor()
    {
        // ดึงข้อมูลนักศึกษาจากฐานข้อมูล
        $advisors = DB::table('advisors')->get();

        return view('adminpages.manageAdvisor', ['advisors' => $advisors]);
    }
}
