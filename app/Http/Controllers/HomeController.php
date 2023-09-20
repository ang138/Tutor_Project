<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Image;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function searchStudent(Request $request)
    {
        $std_id      = $request->input('std_id');
        $birth_day   = $request->input('birth_day');
        $birth_month = $request->input('birth_month');
        $birth_year  = $request->input('birth_year');

        // Query the students table and join with faculties and majors
        $student = DB::table('students')
            ->where('std_id', $std_id)
            ->whereDate('birthdate', "{$birth_year}-{$birth_month}-{$birth_day}")
            ->join('faculties', 'students.std_faculty', '=', 'faculties.id')
            ->join('majors', 'students.std_major', '=', 'majors.id')
            ->select('students.*', 'faculties.name as faculty_name', 'majors.name as major_name')
            ->first();

        $faculties = Faculty::all();
        $majors    = Major::all();

        if ($student)
        {
            if ($student->std_status == 4 || $student->std_status == 5)
            {
                // Student has a status of 4 (tutor), redirect to the tutor status page
                return view('pages.checkTutorStatus', compact('student'));
            }
            else
            {
                // Student found, redirect to the applyTutorForm route with student data
                return view('pages.applyTutorForm', compact('student', 'faculties', 'majors', 'birth_year', 'birth_month', 'birth_day'));
            }
        }
        else
        {
            // Student not found, display a message or handle it as needed
            return redirect()->back()->with('error', 'ไม่พบข้อมูลนิสิต โปรดกรอกข้อมูลใหม่');
        }
    }

    public function showTutorForm()
    {
        // รับข้อมูลนิสิตจาก session (ถ้ามี)
        $student = session('student');

        // ดำเนินการตามความต้องการของคุณ เช่น แสดงข้อมูลนิสิตในแบบฟอร์ม

        return view('pages.applyTutorForm', compact('student'));
    }

    public function updateStudent(Request $request, $std_id)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'std_gpax' => 'required|numeric', // Add validation rules for GPAX
            'std_tel' => 'required|numeric', // Add validation rules for mobile number
            'std_facebook' => 'required|string', // Add validation rules for Facebook
            'std_line' => 'required|string', // Add validation rules for Line ID
        ]);

        // If validation fails, return back with errors
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the student's information in the database
        DB::table('students')
            ->where('std_id', $std_id)
            ->update([
                'std_gpax'     => $request->input('std_gpax'),
                'std_tel'      => $request->input('std_tel'),
                'std_facebook' => $request->input('std_facebook'),
                'std_line'     => $request->input('std_line'),
                'std_status'   => 4, // Update status to 4
            ]);
        DB::table('users')
            ->where('user_id', $std_id)
            ->update([
                'status' => 4, // Update status to 4
            ]);

        // Redirect with a success message

        return redirect('applyTutor')->with('success', 'การสมัครติวเตอร์เสร็จสมบูรณ์');
    }

    public function checkTutorStatus(Request $request)
    {
        // Get the student's tutor-related information based on their session data or query the database
        $student = session('student'); // You may need to modify this depending on how you store tutor-related data

        // Return the tutor status view with the student's information

        return view('pages.tutorStatus', compact('student'));
    }

    public function searcheEroll(Request $request)
    {
        $cus_email   = $request->input('cus_email');
        $birth_day   = $request->input('birth_day');
        $birth_month = $request->input('birth_month');
        $birth_year  = $request->input('birth_year');

        // Query the students table and join with faculties and majors
        $enrollments = DB::table('enrollment_courses')
            ->where('enrollment_courses.cus_email', $cus_email)
            ->whereDate('cus_birthdate', "{$birth_year}-{$birth_month}-{$birth_day}")
            ->join('enrollments', 'enrollment_courses.cus_email', '=', 'enrollments.cus_email')
            ->join('courses', 'enrollment_courses.course_id', '=', 'courses.course_id')
            ->join('subjects', 'courses.course_name', '=', 'subjects.subject_id')
            ->join('student_courses', 'courses.course_id', '=', 'student_courses.course_id')
            ->join('students', 'student_courses.std_id', '=', 'students.std_id')
            ->select(
                'enrollments.cus_name',
                'enrollments.cus_surname',
                'enrollments.cus_email',
                'courses.course_name',
                'subjects.subject_name',
                'students.std_name'
            )
            ->groupBy(
                'enrollments.cus_name',
                'enrollments.cus_surname',
                'enrollments.cus_email',
                'courses.course_name',
                'subjects.subject_name',
                'students.std_name'
            )
            ->get();

        if ($enrollments->count() > 0)
        {
            return view('pages.checkEnrollHistory', compact('enrollments'));
        }
        else
        {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลการลงทะเบียน โปรดข้อมูลใหม่');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {

        $images = Image::all(); // ดึงข้อมูลรูปภาพทั้งหมด

        return view('pages.home', compact('images'));
    }

    public function enrollHistory()
    {
        return view('pages.enrollHistory');
    }
    public function applyTutor()
    {
        return view('pages.applyTutor');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function detail()
    {
        return view('pages.detail');
    }

}
