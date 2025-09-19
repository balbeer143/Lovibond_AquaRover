<?php

namespace App\Http\Controllers;

use App\Imports\usersImportExcel_SD335;
use App\Imports\usersImportExcel_XD7500;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class uploadDataController extends Controller
{
    public function viewUploadDataForm(Request $request)
    {

        return view('uploadData-form');
    }

    public function importExcelData(Request $request)
    { {
            $request->validate([
                'xd7500_files' => 'nullable|mimes:xlsx,xls,csv',
                'sd335_files'  => 'nullable|mimes:xlsx,xls,csv',
            ]);

            if ($request->hasFile('xd7500_files')) {
                Excel::import(new usersImportExcel_XD7500, $request->file('xd7500_files'));
            }

            if ($request->hasFile('sd335_files')) {
                Excel::import(new usersImportExcel_SD335, $request->file('sd335_files'));
            }

            return back()->with('success', 'Excel imported successfully!');
        }
    }
}
