<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function viewAllUser(){

        $users = User::where('role', 'user')->get();

        //dd($users);
        return view('all-user', compact('users'));
    }
}
