<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function index(){
        return view('site.setting');
    }

    public function update_profile(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'phone' => ['required', 'max:50', Rule::unique('users', 'phone')->ignore(Auth::user()->id)],
            'id_number' => 'required|max:255',
        ]);
        User::find(Auth::user()->id)->update($request->only('name', 'email', 'phone', 'id_number'));
        return back()->with('success', 'Data Updated.');
    }

    public function change_password(Request $request){
        $request->validate([
            'current_password' => 'required|max:255',
            'new_password' => 'required|min:8|max:255',
            'confirm_password' => 'required|min:8|max:255|same:new_password',
        ]);
        if(!Hash::check($request->current_password, Auth::user()->password)){
            return back()->with('failed', 'Password yang anda masukan salah.');
        }
        User::find(Auth::user()->id)->update($request->only('password'));
        return back()->with('success', 'Password updated!');
    }
}
