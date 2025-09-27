<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class verifyOtpController extends Controller
{
    public function showVerifyPage($email, $formName)
    {
        return view('auth.otp-verification', compact('email', 'formName'));
    }

    public function verifyOtp(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
            'formName' => 'required'
        ]);

        $user = User::Where('email', $request->email)
            ->Where('otp', $request->otp)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }

        $user->otp = null; // clear OTP

        if ($request->formName === 'register') {
            
            // Mark user as verified
            $user->is_verified = true;
            $user->save();

            // Log the user in
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Successfully logged in!');
        }

        if ($request->formName === 'reset') {
            return redirect()->route('reset.new.password', ['email' => $user->email])
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
