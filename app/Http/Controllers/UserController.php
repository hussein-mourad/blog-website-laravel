<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();
        $reactions = Reaction::all();
        return view('dashboard', compact('users', 'posts', 'comments', 'reactions'));
    }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->role != 'admin') {
            abort(403, 'Unauthorized Action');
        }
        $user->delete();
        return back();
    }
}
