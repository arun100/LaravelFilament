<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
      return view('auth.register');
    }

    public function store(){

        //validate
        //create user
        //redirect
    $validated = request()->validate(
        [
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]
        );

        User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
            );

        return redirect()->route('dashboard')->with('success','New user created');


    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(){

        //dd(request()->all());

        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
            );

        if(auth()->attempt($validated)){
            //Old session removed
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Login successfully');
        }


        return redirect()->route('login')->withErrors([
            'email' => 'Emal and password is not matching !'
        ]);
    }

    public function logout(){

        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success','Logout successfully');

    }
}
