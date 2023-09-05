<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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

     public function home(){
        return view('pages.home');
    }

    public function about(){
        return view('pages.about');
    }

    public function applyTutor(){
        return view('pages.applyTutor');
    }

    public function contact(){
        return view('pages.contact');
    }

    public function subject(){
        return view('pages.subject');
    }

    public function detail(){
        return view('pages.detail');
    }

}
