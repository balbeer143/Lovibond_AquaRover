<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default role
            'otp' => $otp,
            'is_verified' => false,
        ]);
        
        // Send OTP via Mail
        Mail::to($user->email)->send(new SendOtpMail($otp));

        // Redirect to OTP verification page
        return redirect()->route('verify.otp', ['email' => $user->email, 'formName' => 'register'])
            ->with('success', 'Registration successful! Please check your email for the OTP.');
    }
}
