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
        $this->middleware('guest');
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

    public function service(){
        return view('pages.service');
    }

    public function contact(){
        return view('pages.contact');
    }

}
