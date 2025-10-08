<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Carbon\Carbon;
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
            $user->otp_expires_at = Carbon::now()->addMinutes(2);
            $user->save();

            // Send OTP email
            Mail::to($user->email)->send(new SendOtpMail($otp, true));

            session([
                'otp_email' => $request->email,
                'form_name' => 'register'
            ]);

            return redirect()->route('verify.otp')
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
        $user->otp_expires_at = Carbon::now()->addMinutes(2);
        $user->save();


        // Send OTP email
        Mail::to($user->email)->send(new SendOtpMail($otp, false, true));

        session([
            'otp_email' => $request->email,
            'form_name' => $request->formName
        ]);

        return redirect()->route('verify.otp')
            ->with('success', 'OTP sent to your email!');
    }

    public function resetNewPassword()
    {
        return view('auth.reset-new-password');
    }

    public function updateNewPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // clear session
        session()->forget('reset_email');

        return redirect()->route('login')->with('success', 'Password updated successfully. Please login.');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:100',
            'current_password'     => 'nullable|string',
            'new_password'         => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->contact_number = $request->contact_number;
        $user->department = $request->department;

        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $user->password = \Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
