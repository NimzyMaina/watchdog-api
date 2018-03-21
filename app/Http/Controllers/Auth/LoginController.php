<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/calls';

    protected $login_field = 'login';

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
     * Login using Phone or Email
     * @return string User ID
     */
    public function username()
    {
        $request = request();
        // standardize user input
        filter_var(request($this->login_field), FILTER_VALIDATE_EMAIL) ? '' : $request->merge(
            [
                $this->login_field => standardizephone(request($this->login_field))
            ]) ;
        return filter_var(request($this->login_field), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request,[
            $this->login_field => filter_var($request->{$this->login_field},FILTER_VALIDATE_EMAIL) ? 'required|email' :'required|string',
            'password' => 'required|string',
        ] );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [$this->username() => $request->{$this->login_field},
            'password' => $request->password
        ];
    }
}
