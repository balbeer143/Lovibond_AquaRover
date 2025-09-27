<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class loginController
{
    public function login()
    {
        return view('auth.login');
    }
    public function userlogin(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($credentials->fails()) {
            return redirect()->back()->withErrors($credentials)->withInput();
        }

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors([
                'email' => 'This email is not registered with us.',
            ])->withInput();
        }

        if (!$user->is_verified) {

            // Generate new OTP
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->save();

            // Send OTP email
            Mail::to($user->email)->send(new SendOtpMail($otp, true));

            return redirect()->route('verify.otp', ['email' => $user->email, 'formName' => 'register'])
                ->withErrors(['email' => 'Please verify your email before logging in.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Successfully logged in!');
        }
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }

    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    public function resetPasswordSendOtp(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'formName' => 'required',
            ]
        );

        // dd($request->formValue);

        $otp = rand(100000, 999999);
        $user = User::where('email', $request->email)->first();
        $user->otp = $otp;
        $user->save();


        // Send OTP email
        Mail::to($user->email)->send(new SendOtpMail($otp));

        return redirect()->route('verify.otp', ['email' => $request->email, 'formName' => $request->formName])
            ->with('success', 'OTP sent to your email!');
    }

    public function resetNewPassword($email)
    {
        return view('auth.reset-new-password', compact('email'));
    }

    public function updateNewPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users|email',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password updated successfully. Please login.');
    }
}
