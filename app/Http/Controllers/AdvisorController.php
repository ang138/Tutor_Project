<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvisorController extends Controller
{

 // ------------------------------จัดการข้อมูลอาจารย์ที่ปรึกษา-------------------------------
    // ------------เพิ่มข้อมูลอาจารย์--------------
    public function insertadvisorform()
    {
        $data['faculties'] = Faculty::all(["name", "id"]);

        return view('adminpages.addAdvisor', $data);
    }

    public function fetchMajors(Request $request)
    {
        $data['majors'] = Major::where("faculty_id", $request->faculty_id)->get(["name", "id"]);

        return response()->json($data);
    }

    public function insertadvisor(Request $request)
    {
        $request->validate([
            'advisor_name'     => 'required',
            'advisor_surname'  => 'required',
            'advisor_email'    => 'required|email',
            'advisor_password' => 'required',
            'advisor_status'   => 'required',
            'advisor_faculty'  => 'required',
            'advisor_major'    => 'required',
        ]);

        DB::table('advisors')->insert([
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

        $faculties = Faculty::all();
        $majors    = Major::all();

        // Check if the student exists
        if (!$advisor)
        {
            // Handle the case where the student is not found (e.g., display an error message or redirect)
            return redirect()->back()->with('error', 'Advisor not found.');
        }

        // Pass the student data to the view for editing

        return view('adminpages.editAdvisor', compact('advisor', 'faculties', 'majors'));
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


    // -----แสดงข้อมูลอาจารย์-----

    public function manageAdvisor()
    {
        // ดึงข้อมูลนักศึกษาจากฐานข้อมูล
        $advisors = DB::table('advisors')
            ->join('faculties', 'advisors.advisor_faculty', '=', 'faculties.id')
            ->join('majors', 'advisors.advisor_major', '=', 'majors.id')
            ->select('advisors.*', 'faculties.name as faculty_name', 'majors.name as major_name')
            ->get();

        return view('adminpages.manageAdvisor', ['advisors' => $advisors]);
    }




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


    public function advisorHome()
    {
        return view('advisorpages.advisorHome');
    }
    public function approveTutor()
    {
        return view('advisorpages.approveTutor');
    }

}
