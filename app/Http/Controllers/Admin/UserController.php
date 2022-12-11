<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function create()
    {
        return view('admin.create-admin');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => 'required',
            'password' => 'required',
//            'role' => 'required',
            'position' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
//            'role' => $request->role,
            'position' => $request->position,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm(){
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'Авторизация прошла успешно');
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('error', 'Incorrect login or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->home();
    }
}
