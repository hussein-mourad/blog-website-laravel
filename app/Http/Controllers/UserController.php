<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' =>  'required|confirmed|min:6'
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        auth()->login($user);
        return redirect('/');
    }


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
        return back()->withErrors(['password' => 'Invalid Credentials']);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
