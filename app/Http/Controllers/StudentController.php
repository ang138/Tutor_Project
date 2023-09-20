<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        // ทำการ validate ข้อมูล
        $request->validate([
            'std_id'       => 'required|unique:students',
            'std_name'     => 'required',
            'std_surname'  => 'required',
            'std_email'    => 'required|email|unique:students|unique:users,email',
            'std_password' => 'required',
            'std_status'   => 'required',
            'std_faculty'  => 'required',
            'std_major'    => 'required',
            'std_class'    => 'required',
            'birth_day'    => 'required',
            'birth_month'  => 'required',
            'birth_year'   => 'required',
        ]);

        $birthdate = $request->input('birth_year') . '-' . $request->input('birth_month') . '-' . $request->input('birth_day');

        // เพิ่มข้อมูลในตาราง 'students' โดยใช้ Query Builder
        DB::table('students')->insert([
            'std_id'       => $request->input('std_id'),
            'std_name'     => $request->input('std_name'),
            'std_surname'  => $request->input('std_surname'),
            'std_email'    => $request->input('std_email'),
            'std_password' => bcrypt($request->input('std_password')),
            'std_status'   => $request->input('std_status'),
            'std_faculty'  => $request->input('std_faculty'),
            'std_major'    => $request->input('std_major'),
            'std_class'    => $request->input('std_class'),
            'std_gpax'     => null,
            'birthdate'    => $birthdate,
        ]);

        // เพิ่มข้อมูลในตาราง 'users' โดยใช้ Query Builder
        DB::table('users')->insert([
            'name'     => $request->input('std_name'),
            'email'    => $request->input('std_email'),
            'password' => bcrypt($request->input('std_password')),
            'status'   => $request->input('std_status'),
            'user_id'  => $request->input('std_id'),
        ]);

        DB::table('student_advisors')->insert([
            'std_id'      => $request->input('std_id'),
            'advisor1_id' => $request->input('advisor1_id'),
            'advisor2_id' => $request->input('advisor2_id'),
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
            'std_gpax'     => 'nullable|numeric',
            'birth_day'    => 'required',
            'birth_month'  => 'required',
            'birth_year'   => 'required',
        ]);

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

        DB::table('users')
            ->where('user_id', $std_id)
            ->update([
                'name'     => $request->input('std_name'),
                'email'    => $request->input('std_email'),
                'password' => bcrypt($request->input('std_password')),
                'status'   => $request->input('std_status'),
                'user_id'  => $request->input('std_id'), // หากคุณต้องการอัปเดต user_id
                // เพิ่มคอลัมน์อื่นๆ ที่คุณต้องการอัปเดต
            ]);

        return redirect('manageStudent')->with('success', 'แก้ไขข้อมูลนิสิตเรียบร้อยแล้ว');

    }
    // -----สิ้นสุดการอัปเดตข้อมูลนิสิต-----

    // ----------------การลบข้อมูลนิสิต-----------------

    public function deleteStudent($std_id)
    {
        // ตรวจสอบว่ามีข้อมูลนิสิตที่ตรงกับ $std_id หรือไม่
        $student = DB::table('students')
            ->where('std_id', $std_id)
            ->first();

        if ($student)
        {
            // ถ้ามีข้อมูลนิสิต ให้ลบข้อมูลนิสิตในตาราง 'students'
            DB::table('students')
                ->where('std_id', $std_id)
                ->delete();

            // ลบข้อมูลผู้ใช้ในตาราง 'users' โดยใช้ email เพื่อระบุ
            DB::table('users')
                ->where('user_id', $std_id)
                ->delete();

            return redirect('manageStudent')->with('success', 'ลบข้อมูลนิสิตเรียบร้อยแล้ว');
        }
        else
        {
            return redirect('manageStudent')->with('error', 'ไม่พบข้อมูลนิสิตที่ตรงกับรหัสนิสิตที่ระบุ');
        }
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

    public function studentImageProfile(Request $request, $std_id)
    {
        $validator = Validator::make($request->all(), [
            'std_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other fields as needed
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $stdId = Auth::user()->user_id;

        if ($request->hasFile('std_image'))
        {
            $file      = $request->file('std_image');
            $extension = $file->getClientOriginalExtension();
            $fileName  = time() . '.' . $extension;
            $file->move('assets/images', $fileName);

            // Update the 'payment_receipt' column in the database
            DB::table('students')
                ->where('std_id', $stdId)
                ->update(['std_image' => 'assets/images/' . $fileName]);
        }

        return redirect('tutorHome')->with('success', 'อัปเดตข้อมูลรูปภาพเรียบร้อยแล้ว');
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
        $stdId = Auth::user()->user_id;

        $students = DB::table('students')
            ->join('faculties', 'students.std_faculty', '=', 'faculties.id')
            ->join('majors', 'students.std_major', '=', 'majors.id')
            ->where('students.std_id', $stdId)
            ->select('students.*', 'faculties.name as faculty_name', 'majors.name as major_name')
            ->first();

        if (!$students)
        {
            // Handle case when tutor information is not found
            return redirect()->route('home')->with('error', 'Tutor information not found');
        }

        return view('tutorpages.tutorHome', ['students' => $students]);
    }

    public function manageSubject()
    {
        // Get the currently logged-in tutor's ID

        $stdId = Auth::user()->user_id; // Adjust this according to your user structure

        $students = DB::table('students')
            ->join('faculties', 'students.std_faculty', '=', 'faculties.id')
            ->join('majors', 'students.std_major', '=', 'majors.id')
            ->where('students.std_id', $stdId)
            ->select('students.*', 'faculties.name as faculty_name', 'majors.name as major_name')
            ->first();

        if (!$students)
        {
            // Handle case when tutor information is not found
            return redirect()->route('home')->with('error', 'Tutor information not found');
        }

        // Query the student_advisor table to get students under the advisor's supervision

        $courses = DB::table('student_courses')
            ->join('courses', 'student_courses.course_id', '=', 'courses.course_id')
            ->join('subjects', 'courses.course_name', '=', 'subjects.subject_id')
            ->where('student_courses.std_id', $stdId)
            ->select('courses.*', 'subjects.subject_name')
            ->orderByRaw('CASE
                         WHEN courses.course_status = 1 THEN 1   -- เปิด
                         WHEN courses.course_status = 2 THEN 2   -- ปิด
                         WHEN courses.course_status = 3 THEN 3   -- เต็ม
                         ELSE 4                                   -- สถานะอื่น ๆ
                            END')
            ->get();

        return view('tutorpages.manageSubject', ['courses' => $courses, 'students' => $students]);
    }

    public function enrollment()
    {

        // Get the currently logged-in tutor's ID

        $stdId = Auth::user()->user_id; // Adjust this according to your user structure

        $students = DB::table('students')
            ->join('faculties', 'students.std_faculty', '=', 'faculties.id')
            ->join('majors', 'students.std_major', '=', 'majors.id')
            ->where('students.std_id', $stdId)
            ->select('students.*', 'faculties.name as faculty_name', 'majors.name as major_name')
            ->first();

        if (!$students)
        {
            // Handle case when tutor information is not found
            return redirect()->route('home')->with('error', 'Tutor information not found');
        }

        // Query the student_advisor table to get students under the advisor's supervision

        $courses = DB::table('student_courses')
            ->join('courses', 'student_courses.course_id', '=', 'courses.course_id')
            ->join('subjects', 'courses.course_name', '=', 'subjects.subject_id')
            ->where('student_courses.std_id', $stdId)
            ->select('courses.*', 'subjects.subject_name')
            ->get();

        return view('tutorpages.enrollment', ['courses' => $courses, 'students' => $students]);
    }
}
