<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            $user = auth()->user();

            if ($user->status == 1)
            {
                return redirect()->route('adminHome');
            }
            elseif ($user->status == 2)
            {
                return redirect()->route('advisorHome');
            }
            elseif ($user->status == 3)
            {
                return view('auth.login');
                // return redirect('login')->with('error', 'You need to register as a tutor before.');
            }
            elseif ($user->status == 4)
            {
                return redirect('login')->with('error', 'Please wait for admin approval.');
            }
            elseif ($user->status == 5)
            {
                return redirect()->route('tutorHome');
            }
        }
        else
        {
            // Authentication failed
            $userWithEmail = User::where('email', $input['email'])->first();

            // if ($userWithEmail) {
            //     if ($userWithEmail->status !== 1 && $userWithEmail->status !== 2 && $userWithEmail->status !== 5) {
            //         // Email exists in the database, but status is not 1, 2, or 5
            //         return redirect('login')->with('error', 'Invalid status for this email.');
            //     }
            // }

            // // Email and Password are wrong
            return redirect('login')->with('error', 'Email and Password are wrong.');
        }
    }
}
