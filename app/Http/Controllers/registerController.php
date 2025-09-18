<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }
    public function registerSave(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->withErrors($Validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user', // default role
        ]);
        
        if ($user) {
            return redirect()->route('login')->with('Success', 'Registration successful!');
        }
    }
}
