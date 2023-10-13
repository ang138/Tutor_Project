<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
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
            // 'birth_day'    => 'required',
            // 'birth_month'  => 'required',
            // 'birth_year'   => 'required',
            'birthdate'    => 'required|date',
        ]);

        // $birthdate = $request->input('birth_year') . '-' . $request->input('birth_month') . '-' . $request->input('birth_day');
        $birthdate = $request->input('birthdate');

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

        $advisors = Advisor::all();

        $studentAdvisors = DB::table('student_advisors')
            ->where('std_id', $std_id)
            ->first();

        // Check if the student exists
        if (!$student)
        {
            // Handle the case where the student is not found (e.g., display an error message or redirect)
            return redirect()->back()->with('error', 'Student not found.');
        }

        $decryptedPassword = bcrypt($student->std_password);

        // Extract the birthdate into separate variables (day, month, year)
        list($birth_year, $birth_month, $birth_day) = explode('-', $student->birthdate);

        // Pass the student data to the view for editing, including birthdate variables

        return view('adminpages.editStudent', compact('student', 'faculties', 'majors', 'birth_year', 'birth_month', 'birth_day', 'decryptedPassword', 'advisors', 'studentAdvisors'));

    }

    public function updateStudent(Request $request, $std_id)
    {
        // Validate the incoming request data here

        // Use the query builder to update the student's information
        // $birthdate = $request->input('birth_year') . '-' . $request->input('birth_month') . '-' . $request->input('birth_day');
        $birthdate = $request->input('birthdate');

        DB::beginTransaction(); // Start a database transaction

        try {
            $updateData = [
                'std_name'     => $request->input('std_name'),
                'std_surname'  => $request->input('std_surname'),
                'std_email'    => $request->input('std_email'),
                'std_password' => bcrypt($request->input('std_password')),
                'std_status'   => $request->input('std_status'),
                'std_faculty'  => $request->input('std_faculty'),
                'std_major'    => $request->input('std_major'),
                'std_class'    => $request->input('std_class'),
                'std_gpax'     => $request->input('std_gpax'),
                'birthdate'    => $birthdate,
            ];

            // Check if each field has a value before updating
            foreach ($updateData as $key => $value)
            {
                if ($value !== null)
                {
                    DB::table('students')
                        ->where('std_id', $std_id)
                        ->update([$key => $value]);
                }
            }

            // Update user data (assuming the user_id remains the same)
            $updateUserData = [
                'name'     => $request->input('std_name'),
                'email'    => $request->input('std_email'),
                'password' => bcrypt($request->input('std_password')),
                'status'   => $request->input('std_status'),
            ];

            foreach ($updateUserData as $key => $value)
            {
                if ($value !== null)
                {
                    DB::table('users')
                        ->where('user_id', $std_id)
                        ->update([$key => $value]);
                }
            }

            // Update student_advisors data
            $updateAdvisorsData = [
                'advisor1_id' => $request->input('advisor1_id'),
                'advisor2_id' => $request->input('advisor2_id'),
            ];

            foreach ($updateAdvisorsData as $key => $value)
            {
                if ($value !== null)
                {
                    DB::table('student_advisors')
                        ->where('std_id', $std_id)
                        ->update([$key => $value]);
                }
            }

            DB::commit(); // Commit the transaction

            return redirect('manageStudent')->with('success', 'แก้ไขข้อมูลนิสิตเรียบร้อยแล้ว');
        }
        catch (\Exception $e)
        {
            DB::rollback(); // Rollback the transaction in case of an error

            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . $e->getMessage());
        }
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

            DB::table('student_advisors')
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
            'std_image' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
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
            ->whereIn('courses.course_status', [1, 2, 3])
            ->select('courses.*', 'subjects.subject_name')
            ->orderByRaw('CASE
                         WHEN courses.course_status = 1 THEN 1   -- เปิด
                         WHEN courses.course_status = 2 THEN 2   -- ปิด
                         WHEN courses.course_status = 3 THEN 3   -- เต็ม
                         ELSE 4                                   -- สถานะอื่น ๆ
                            END')
            ->get();

        $coursesWithStatus3 = $courses->filter(function ($course)
        {
            return $course->course_status == 3;
        });

        return view('tutorpages.manageSubject', ['courses' => $courses, 'students' => $students, 'coursesWithStatus3' => $coursesWithStatus3]);
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
