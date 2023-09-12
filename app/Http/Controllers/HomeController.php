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
            return view('pages.applyTutor')->with('error', 'ไม่พบนิสิตด้วยรหัสนิสิตที่ระบุ');
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

    public function about()
    {
        return view('pages.about');
    }

    public function applyTutor()
    {
        return view('pages.applyTutor');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function subject()
    {
        return view('pages.subject');
    }

    public function detail()
    {
        return view('pages.detail');
    }

}
