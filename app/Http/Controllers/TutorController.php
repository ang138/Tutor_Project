<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorController extends Controller
{
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

    public function tutorHome()
    {
        return view('tutorpages.tutorHome');
    }
    public function tutorProfile()
    {
        return view('tutorpages.tutorProfile');
    }

    public function advisorHome()
    {
        return view('pages.advisorHome');
    }

    public function adminHome()
    {
        return view('pages.adminHome');
    }
}
