<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([            
            'email' => 'required|max:50',
            'password' => 'required|max:50',
            'remember' => 'bool',
        ]);  
        $request['name'] = $request->email;      
        if(Auth::attempt($request->only('email', 'password'), $request->remember) or Auth::attempt($request->only('name', 'password'), $request->remember)){
            if(authAs('admin')) return redirect('/admin');
            if(authAs('doctor')) return redirect('/workspace');
            if(authAs('pharmacist')) return redirect('/pharmacy');
            return redirect('/appointment');
        }
        return redirect()->back()->with('Failed', 'Email atau password salah.');
    }

    function register(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users|email|max:50',
            'phone' => 'required|max:50',
            'id_number' => 'required|unique:users|max:100',
            'address' => 'required|max:255',
            'password' => 'required|max:50|min:8',
            'confirm_password' => 'required|max:50|min:8|same:password',
        ]);

        $request['rm'] = setRm();
        $user = User::create($request->all());
        Auth::login($user);
        return redirect('/appointment');
    }

    public function logout() {
        Auth::logout(Auth::user());
        return redirect('/login');
    }
}
