<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class verifyOtpController extends Controller
{
    public function showVerifyPage()
    {

        // Check if session exists
        if (!session()->has('otp_email') || !session()->has('form_name')) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $email = session('otp_email');
        $formName = session('form_name');

        return view('auth.otp-verification', compact('email', 'formName'));
    }

    public function verifyOtp(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
        ]);

        $email = session('otp_email');
        $formName = session('form_name');

        $user = User::Where('email', $email)
            ->Where('otp', $request->otp)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }

        $user->otp = null; // clear OTP

        if ($formName === 'register') {

            // Mark user as verified
            $user->is_verified = true;
            $user->save();

            // Log the user in
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Successfully logged in!');
        }

        if ($formName === 'reset') {

            $user->save();

            session(['reset_email' => $email]);

            // Clear OTP session
            session()->forget('otp_email');
            session()->forget('form_name');

            return redirect()->route('reset.new.password')
                ->with('success', 'OTP verified! You can now reset your password.');
        }
    }

    // Resend OTP
    public function resendOtp($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('register')->with('error', 'User not found. Please register again.');
        }

        // Generate new OTP
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        // Send OTP email
        Mail::to($user->email)->send(new SendOtpMail($otp));

        return redirect()->back()->with('success', 'A new OTP has been sent to your email.');
    }
}
