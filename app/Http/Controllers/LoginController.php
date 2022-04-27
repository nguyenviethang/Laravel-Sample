<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = ($request->remember) ? true : false;
        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->role_id == config('const.ROLE.USER')) {
                return redirect()->route('profile');
            } else {
                return Redirect::route('user.list');
            }
        } else {
            return Redirect::route('login')->with('error', __('message.loginFail'));
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function view()
    {
        return redirect()->route('login');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        } else {
            return view('login');
        }
    }
}
