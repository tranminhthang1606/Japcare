<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated()
    {
        if(Auth::guard('web'))
        {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('auth.login');
    }


    public function index()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => true])) {
                $user = $request->user('web');
                Auth::guard('web')->login($user);
                return redirect()->route('admin.dashboard');
            } else {
                return back()->withErrors(['email' => ['Email or password not correct!']]);
            }
        } catch (\Exception $e) {
            Log::notice("Login  false" . ' ' . Carbon::now());
            return back()->withErrors(['email' => ['Email or password not correct!.']]);
        }
    }

    public function logout(Request $request)
    {
        if(auth()->guard('web')->user()){
            Auth::guard('web')->logout();
            return redirect()->route('auth.login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
