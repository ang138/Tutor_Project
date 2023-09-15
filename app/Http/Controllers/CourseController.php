<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\student_course;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function addCourseForm()
    {
        $subjects = Subject::all();

        return view('tutorpages.addCourse', ['subjects' => $subjects]);
    }

    public function insertCourse(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'subject_id'          => 'required',
            'course_content'      => 'required',
            'course_type'         => 'nullable',
            'number_of_students'  => 'nullable|numeric|min:1',
            'teaching_days'       => 'required',
            'teaching_times'      => 'required',
            'course_price'        => 'required',
            'message_to_students' => 'required',
            'course_status'       => 'required',
            'payment_receipt'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other fields as needed
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        // Check if 'course_type' is 'สอนตัวต่อตัว' and set 'number_of_students' to 1
        if ($request->input('course_type') === 'สอนตัวต่อตัว')
        {
            $numberOfStudents = 1;
        }
        else
        {
            $numberOfStudents = $request->input('number_of_students');
        }

        // Check if both checkboxes are selected and store their values as an array
        $location = $request->input('location', []);

        $course                      = new course();
        $course->course_name         = $request->input('subject_id');
        $course->course_content      = $request->input('course_content');
        $course->location            = implode(', ', $location);
        $course->course_type         = $request->input('course_type');
        $course->number_of_students  = $numberOfStudents;
        $course->teaching_days       = $request->input('teaching_days');
        $course->teaching_times      = $request->input('teaching_times');
        $course->course_price        = $request->input('course_price');
        $course->message_to_students = $request->input('message_to_students');
        $course->course_status       = $request->input('course_status');

        if ($request->hasFile('payment_receipt'))
        {
            $file      = $request->file('payment_receipt');
            $extension = $file->getClientOriginalExtension();
            $fileName  = time() . '.' . $extension;
            $file->move('assets/images', $fileName);
            $course->payment_receipt = 'assets/images/' . $fileName; // Store the path in the database
        }

        $course->save();

        $studentCourse            = new student_course();
        $studentCourse->std_id    = auth()->user()->user_id; // Assuming you are getting the student's ID from authentication
        $studentCourse->course_id = $course->id;
        $studentCourse->save();

        return redirect('manageSubject')->with('success', 'เพิ่มข้อมูลนิสิตเรียบร้อยแล้ว');
    }

    public function viewCourseDetails($course_id)
    {
        // Query the database to get the course details based on $course_id
        $course = DB::table('courses')->where('course_id', $course_id)->first();

        if (!$course)
        {
            return redirect()->back()->with('error', 'Course not found');
        }

        // Query the subjects table to get the subject name
        $subject = DB::table('subjects')->where('subject_id', $course->course_name)->value('subject_name');

        // Pass the course and subject details to a view and return it

        return view('tutorpages.courseDetails', ['course' => $course, 'subject' => $subject]);
    }

    public function editCourse($course_id)
    {
        // Retrieve the course details for editing
        $course = DB::table('courses')->where('course_id', $course_id)->first();

        if (!$course)
        {
            return redirect()->back()->with('error', 'Course not found');
        }

        // Retrieve the subject name based on course_name
        $subject = Subject::where('subject_id', $course->course_name)->value('subject_name');

        // Get a list of subjects for the dropdown
        $subjects = Subject::all();

        $locations = explode(', ', $course->location);

        return view('tutorpages.editCourse', compact('course', 'subject', 'subjects', 'locations'));

    }

    public function updatenewCourse(Request $request, $course_id)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'subject_id'          => 'required',
            'course_content'      => 'required',
            'course_type'         => 'nullable',
            'number_of_students'  => 'nullable|numeric|min:1',
            'teaching_days'       => 'required',
            'teaching_times'      => 'required',
            'course_price'        => 'required',
            'message_to_students' => 'required',
            'course_status'       => 'required',
            'payment_receipt'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for other fields as needed
        ]);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        // Check if 'course_type' is 'สอนตัวต่อตัว' and set 'number_of_students' to 1
        $numberOfStudents = $request->input('course_type') === 'สอนตัวต่อตัว' ? 1 : $request->input('number_of_students');

        // Check if both checkboxes are selected and store their values as an array
        $location = $request->input('location', []);

        // Build the SQL UPDATE statement
        DB::table('courses')
            ->where('course_id', $course_id)
            ->update([
                'course_name'         => $request->input('subject_id'),
                'course_content'      => $request->input('course_content'),
                'location'            => implode(', ', $location),
                'course_type'         => $request->input('course_type'),
                'number_of_students'  => $numberOfStudents,
                'teaching_days'       => $request->input('teaching_days'),
                'teaching_times'      => $request->input('teaching_times'),
                'course_price'        => $request->input('course_price'),
                'message_to_students' => $request->input('message_to_students'),
                'course_status'       => $request->input('course_status'),
            ]);

        // Handle the file upload for 'payment_receipt' if it exists
        if ($request->hasFile('payment_receipt'))
        {
            $file      = $request->file('payment_receipt');
            $extension = $file->getClientOriginalExtension();
            $fileName  = time() . '.' . $extension;
            $file->move('assets/images', $fileName);

            // Update the 'payment_receipt' column in the database
            DB::table('courses')
                ->where('course_id', $course_id)
                ->update(['payment_receipt' => 'assets/images/' . $fileName]);
        }

        $std_id = auth()->user()->user_id;

        // Check if there is an existing record in the student_course table for this student and course
        $existingRecord = DB::table('student_courses')
            ->where('std_id', $std_id)
            ->where('course_id', $course_id)
            ->first();

        if ($existingRecord)
        {
            // If a record already exists, update the values
            DB::table('student_courses')
                ->where('std_id', $std_id)
                ->where('course_id', $course_id)
                ->update([
                    'std_id'    => $std_id,
                    'course_id' => $course_id,
                ]);
        }
        else
        {
            // If no record exists, insert a new record
            DB::table('student_courses')->insert([
                'std_id'    => $std_id,
                'course_id' => $course_id,
            ]);
        }

        return redirect('manageSubject')->with('success', 'แก้ไขข้อมูลนิสิตเรียบร้อยแล้ว');
    }

}
