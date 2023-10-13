<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\enrollment_course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function subject()
    {
        $subjects = DB::table('subjects')->get();

        return view('pages.subject', ['subjects' => $subjects]);
    }

    public function showcourseOpen($subject_id)
    {
        $subjects = DB::table('subjects')
            ->where('subject_id', '=', $subject_id)
            ->first();

        // Fetch courses based on the selected subject_id and join with subjects to get subject_name
        $courses = DB::table('courses')
            ->where('courses.course_name', '=', $subject_id)
            ->where('courses.course_status', '=', 1)
            ->join('subjects', 'courses.course_name', '=', 'subjects.subject_id')
            ->join('student_courses', function ($join)
        {
                $join->on('courses.course_id', '=', 'student_courses.course_id')
                    ->join('students', 'students.std_id', '=', 'student_courses.std_id');
            })
            ->select('courses.*', 'students.*', 'subjects.subject_name')
            ->get();

        // $registeredUsersCount = DB::table('courses')
        //     ->where('courses.course_name', '=', $subject_id)
        //     ->join('enrollment_courses', function ($join)
        // {
        //         $join->on('courses.course_id', '=', 'enrollment_courses.course_id');
        //     })
        //     ->count();

        // $tutors = DB::table('student_courses')
        //     ->join('students', 'student_courses.std_id', '=', 'students.std_id')
        //     ->join('courses', 'student_courses.course_id', '=', 'courses.course_id')
        //     ->where('course_name', '=', $subject_id)
        //     ->select('students.std_id', 'students.std_name', 'students.std_email')
        //     ->get();

        return view('pages.courseOpen', ['subjects' => $subjects, 'courses' => $courses]);
    }

    public function courseOpenDetail($course_id)
    {
        $course = DB::table('courses')
            ->where('course_id', '=', $course_id)
            ->first();

        // ดึงข้อมูลนิสิตที่เรียนคอร์สนี้
        $students = DB::table('student_courses')
            ->join('students', 'student_courses.std_id', '=', 'students.std_id')
            ->join('courses', 'student_courses.course_id', '=', 'courses.course_id')
            ->join('subjects', 'courses.course_name', '=', 'subjects.subject_id')
            ->join('faculties', 'students.std_faculty', '=', 'faculties.id')
            ->join('majors', 'students.std_major', '=', 'majors.id')
            ->where('student_courses.course_id', '=', $course_id)
            ->select('students.*', 'courses.*', 'subjects.subject_name', 'subjects.subject_id', 'faculties.name as faculty_name', 'majors.name as major_name')
            ->first();

        if (!$students)
        {
            // Handle case when tutor information is not found
            return redirect()->route('home')->with('error', 'Tutor information not found');
        }

        return view('pages.detail', ['students' => $students, 'course' => $course]);
    }

    public function enrollForm($course_id)
    {
        $course = DB::table('courses')
            ->where('course_id', '=', $course_id)
            ->select('courses.*')
            ->first();

        if (!$course)
        {
            // Handle case when tutor information is not found
            return redirect()->route('home')->with('error', 'Tutor information not found');
        }

        return view('pages.enrollmentCourse', ['course' => $course]);
    }

    public function insertEnrollCourseAction(Request $request, $course_id)
    {

        // Validate the form input
        $validator = Validator::make($request->all(), [
            'cus_name'     => 'required|string',
            'cus_surname'  => 'required|string',
            'cus_email'    => 'required|email',
            // 'birth_day'    => 'required|numeric',
            // 'birth_month'  => 'required|numeric',
            // 'birth_year'   => 'required|numeric',
            'cus_birthdate'    => 'required|date',
            'cus_tel'      => 'required|string',
            'cus_facebook' => 'required|string',
            'cus_line'     => 'required|string',
            'course_id'    => 'nullable|numeric', // You may want to validate this further
            'cus_bill' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other fields as needed
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $isEnrolled = DB::table('enrollment_courses')
            ->where('cus_email', $request->input('cus_email'))
            ->where('course_id', $course_id)
            ->exists();

        if ($isEnrolled)
        {
            return back()->with('error', 'คุณได้ลงทะเบียนในคอร์สนี้แล้ว');
        }

        $emailExists = DB::table('enrollments')
            ->where('cus_email', $request->input('cus_email'))
            ->exists();

        if (!$emailExists)
        {
            // Create a new enrollment record
            $enrollment                = new Enrollment();
            $enrollment->cus_name      = $request->input('cus_name');
            $enrollment->cus_surname   = $request->input('cus_surname');
            $enrollment->cus_email     = $request->input('cus_email');
            // $enrollment->cus_birthdate = $request->input('birth_year') . '-' . $request->input('birth_month') . '-' . $request->input('birth_day');
            $enrollment->cus_birthdate = $request->input('cus_birthdate');
            $enrollment->cus_tel       = $request->input('cus_tel');
            $enrollment->cus_facebook  = $request->input('cus_facebook');
            $enrollment->cus_line      = $request->input('cus_line');

            $enrollment->save();

        }

        $enrollmentCourse            = new enrollment_course();
        $enrollmentCourse->cus_email = $request->input('cus_email'); // Assuming you are getting the student's ID from authentication
        $enrollmentCourse->course_id = $course_id;

        if ($request->hasFile('cus_bill'))
        {
            $file      = $request->file('cus_bill');
            $extension = $file->getClientOriginalExtension();
            $fileName  = time() . '.' . $extension;
            $file->move('assets/images', $fileName);
            $enrollmentCourse->cus_bill = 'assets/images/' . $fileName; // Store the path in the database
        }

        $enrollmentCourse->save();

        // $enrollmentsCount = DB::table('enrollment_courses')->where('course_id', $course_id)->count();
        // $course           = DB::table('courses')->where('course_id', $course_id)->first();

        // if ($enrollmentsCount >= $course->number_of_students)
        // {
        //     // อัปเดตสถานะของคอร์สเป็น "เต็ม" หรือสถานะที่คุณต้องการ
        //     DB::table('courses')
        //         ->where('course_id', $course_id)
        //         ->update(['course_status' => 3]);
        // }

        DB::table('courses')
            ->where('course_id', $course_id) // กำหนดคอร์สที่ต้องการลดจำนวนที่เปิดสอน
            ->decrement('number_of_students', 1);

// ตรวจสอบถ้า number_of_students เท่ากับ 0 ให้เปลี่ยนสถานะ course_status เป็น 3
        $course = DB::table('courses')->where('course_id', $course_id)->first();

        if ($course->number_of_students == 0)
        {
            DB::table('courses')
                ->where('course_id', $course_id)
                ->update(['course_status' => 3]);
        }

        return redirect('subject')->with('success', 'ลงทะเบียนเรียนเสร็จสิ้น');
    }

}
