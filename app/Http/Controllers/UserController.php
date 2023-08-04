<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' =>  'required'
        ]);

        if (auth()->attempt($data)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->withErrors(['failed' => 'Invalid Credentials']);
    }
}
