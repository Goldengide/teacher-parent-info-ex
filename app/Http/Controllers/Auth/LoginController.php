<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginPost(Request $request) {
        if($request->input('remember') == null) { $remember = 0;}
        else {$remember = 1; }
        // return $request->input('remember');
        if(Auth::attempt(['phone'=>$request->input('phone'), 'password'=>$request->input('password') ], $remember))
        {
            if(Auth::user() && Auth::user()->role == "admin")
            {
                return redirect('/super-admin/dashboard');
            }
            
            if(Auth::user() && Auth::user()->role == "parent")
            {
                return redirect('/parent/dashboard');
            }

            if(Auth::user() && Auth::user()->role == "teacher")
            {
                return redirect('/teacher/dashboard');
            }
            
            

            /*if(Auth::user() && Auth::user()->role == 'regular')
            {
                return redirect('/400');
            }*/
        }
        else {
            return redirect()->back()->with(['message'=>'Your credentials are not matching with our records. Please try again', 'style' => 'alert-danger']);
        }
    }

    public function loginPage() {
        return view('auth.login');
    }

    
}
