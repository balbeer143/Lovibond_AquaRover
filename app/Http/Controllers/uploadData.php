<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class uploadData extends Controller
{
    public function viewUploadDataForm(Request $request){
        
        return view('uploadData-form');
    }
}
