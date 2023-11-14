<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $loginPath = '/login';
    protected $redirectPath = '/dashboard';
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        $request->session()->flush();
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'active_status'=>'1'])){
            $user = auth()->user();
            //self:afterLogin($user);
            return redirect()->intended(route('dashboard'));
        }
        return redirect()->route('login')->withInput()
                ->withWarningMessage('Email or password is incorrect');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function afterLogin($user){

    }
}
