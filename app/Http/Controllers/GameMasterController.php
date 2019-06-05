<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameMasterController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    function checklogin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|alphaNum|min:3'
        ]);

        $user_data = array(
            'name' => $request->get('name'),
            'password' => $request->get('password')
        );

        if (Auth::attempt($user_data)) {
            return redirect('gm');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }

    }

    function successlogin()
    {
        if (Auth::check() and Auth::user()->isGM)
            return view('auth.successlogin');
        else if (Auth::check())
            return redirect('/');
        else
            return redirect('gm/login');
    }

    function logout()
    {
        Auth::logout();
        return redirect('gm/login');
    }
}