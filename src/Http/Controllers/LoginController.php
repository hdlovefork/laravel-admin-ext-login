<?php

namespace Dean\Login\Http\Controllers;

use Dean\Login\Login;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Encore\Admin\Controllers\AuthController as BaseAuthController;

class LoginController extends BaseAuthController
{
    use ThrottlesLogins;
    
    public $maxAttempts;
    public $decayMinutes;
    
    public function __construct()
    {
        $this->maxAttempts  = Login::config('maxAttempts', 5);
        $this->decayMinutes = Login::config('decayMinutes', 1);
    }
    
    
    public function getLogin()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }
        return view('dean::login');
    }
    
    public function postLogin(Request $request)
    {
        $credentials = $request->only([$this->username(), 'password', 'captcha']);
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($credentials, $this->loginRules());
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        unset($credentials['captcha']);
        if ($this->guard()->attempt($credentials)) {
            return $this->sendLoginResponse($request);
        }
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }
    
    protected function loginRules()
    {
        $rules = [
            $this->username() => 'required',
            'password'        => 'required'
        ];
        if (Login::config('verification_code_enable')) {
            $rules['captcha'] = 'required|captcha';
        }
        return $rules;
    }
}