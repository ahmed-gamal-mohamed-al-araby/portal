<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $userNameOrEmailOrCode = request()->input('userName_or_email_or_code');
        if (filter_var($userNameOrEmailOrCode, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } elseif (filter_var($userNameOrEmailOrCode, FILTER_VALIDATE_INT)) {
            $field = 'code';
        } else {
            $field = 'username';
        }
        request()->merge([$field => $userNameOrEmailOrCode]);

        return $field;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'userName_or_email_or_code' => [trans('auth.failed')],
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'userName_or_email_or_code' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
