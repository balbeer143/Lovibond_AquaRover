<?php

namespace App\Http\Controllers;

use App\Imports\usersImportExcel_MD610;
use App\Imports\usersImportExcel_SD335;
use App\Imports\usersImportExcel_SD400_OXI_L;
use App\Imports\usersImportExcel_TB350;
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
    {
        // dd($request->all());
        $request->validate([
            'xd7500_files' => 'nullable|mimes:xlsx,xls,csv',
            'sd335_files'  => 'nullable|mimes:xlsx,xls,csv',
            'md610_files' => 'nullable|mimes:xlsx,xls,csv',
            'sd400_oxi_l_field' => 'nullable|mimes:xlsx,xls,csv',
            'tb350_files' => 'nullable|mimes:xlsx,xls,csv',
        ]);

        if ($request->hasFile('xd7500_files')) {
            Excel::import(new usersImportExcel_XD7500, $request->file('xd7500_files'));
        }

        if ($request->hasFile('sd335_files')) {
            Excel::import(new usersImportExcel_SD335, $request->file('sd335_files'));
        }

        if ($request->hasFile('md610_files')) {
            Excel::import(new usersImportExcel_MD610, $request->file('md610_files'));
        }
        if ($request->hasFile('sd400_oxi_l_field')) {
            Excel::import(new usersImportExcel_SD400_OXI_L, $request->file('sd400_oxi_l_field'));
        }
        if ($request->hasFile('tb350_files')) {
            Excel::import(new usersImportExcel_TB350, $request->file('tb350_files'));
        }

        return back()->with('success', 'Excel imported successfully!');
    }
}
