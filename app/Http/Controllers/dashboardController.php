<?php

namespace App\Http\Controllers;

use App\Models\AquaRoverFormData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function dashboardPage()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin → total submissions of all users
            $uploadsCount = AquaRoverFormData::count();
            $uploadsLabel = "Total Form Submissions";
        } else {
            // Normal user → only their own submissions
            $uploadsCount = $user->submissions()->count();
            $uploadsLabel = "Your Uploads";
        }
        return view('dashboard', compact('uploadsCount', 'uploadsLabel', 'user'));
    }
}
