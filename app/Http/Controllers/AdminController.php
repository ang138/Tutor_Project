<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    // ------------------------------จัดการข้อมูลนิสิต-------------------------------
    // ------------เพิ่มข้อมูล--------------
    public function insertstdform()
    {
        return view('adminpages.addStudent');
    }

    public function insertstd(Request $request)
    {
        // รับข้อมูลจากคำขอ HTTP
        $std_id       = $request->input('std_id');
        $std_name     = $request->input('std_name');
        $std_surname  = $request->input('std_surname');
        $std_email    = $request->input('std_email');
        $std_password = $request->input('std_password');
        $std_status   = $request->input('std_status');
        $std_faculty  = $request->input('std_faculty');
        $std_major    = $request->input('std_major');
        $std_class    = $request->input('std_class');

        // เก็บข้อมูลเข้าฐานข้อมูล
        DB::table('students')->insert([
            'std_id'       => $std_id,
            'std_name'     => $std_name,
            'std_surname'  => $std_surname,
            'std_email'    => $std_email,
            'std_password' => $std_password,
            'std_status'   => $std_status,
            'std_faculty'  => $std_faculty,
            'std_major'    => $std_major,
            'std_class'    => $std_class,
            'std_gpax'     => null, // เก็บค่าว่างในฐานข้อมูล
            'std_grade' => null, // เก็บค่าว่างในฐานข้อมูล
        ]);

        // เพิ่ม Flash Message

        // return redirect()->back()->with('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');

        return redirect('manageStudent')->with('success', 'แก้ไขข้อมูลนิสิตเรียบร้อยแล้ว');

        // echo "Record inserted successfully.<br/>";
        // echo '<a href = "/manageStudent">Click Here</a> to go back.';
    }

    // -----สิ้นสุดการเพิ่มข้อมูล-----


    // ---------------อัปเดตข้อมูล------------------

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

        // Redirect back to the edit page or a different page after updating

        // return redirect()->back()->with('success', 'แก้ไขข้อมูลนิสิตเรียบร้อยแล้ว');

        return redirect('manageStudent')->with('success', 'แก้ไขข้อมูลนิสิตเรียบร้อยแล้ว');

    }
    // -----สิ้นสุดการอัปเดตข้อมูล-----

    // ----------------การลบข้อมูล-----------------

    public function deleteStudent($std_id)
    {
        // Delete the student record from the database
        DB::table('students')->where('std_id', $std_id)->delete();

        // Redirect to the "manageStudent" page with a success message

        return redirect()->route('manageStudent')->with('success', 'ลบข้อมูลนิสิตเรียบร้อยแล้ว');
    }

    // -----สิ้นสุดการลบข้อมูล-----

    // ------------------------------จัดการข้อมูลอาจารย์ที่ปรึกษา-------------------------------

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
    public function manageStudent()
    {

        // ดึงข้อมูลนักศึกษาจากฐานข้อมูล
        $students = DB::table('students')->get();

        return view('adminpages.manageStudent', ['students' => $students]);
    }
    public function manageAdvisor()
    {
        return view('adminpages.manageAdvisor');
    }
}
