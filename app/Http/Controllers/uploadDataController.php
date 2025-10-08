<?php

namespace App\Http\Controllers;

use App\Imports\usersImportExcel_MD610;
use App\Imports\usersImportExcel_SD335;
use App\Imports\usersImportExcel_SD400_OXI_L;
use App\Imports\usersImportExcel_TB350;
use App\Imports\usersImportExcel_XD7500;
use App\Models\AquaRoverFormData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class uploadDataController extends Controller
{
    public function viewUploadDataForm(Request $request)
    {

        $user = Auth::user();
        return view('aquarover-form', compact('user'));
    }

    public function viewAllUploadData()
    {
        if (Auth::user()->role === 'admin') {
            $allUploadData = AquaRoverFormData::all();
        } else {
            $allUploadData = AquaRoverFormData::where('user_id', Auth::id())->get();
        }
        return view('show-form-data', compact('allUploadData'));
    }

    public function importExcelData(Request $request)
    {
        // dd($request->all());
        $request->merge([
            'mobile' => preg_replace('/\s+/', '', $request->mobile),
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'tested_by' => 'required|string',
            'mobile' => ['required', 'digits:10'],
            'email' => 'required|email',
            'address' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'village' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'sd40_files' => 'nullable|image',
            'sample_type' => 'required|string',
            'source_category' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'instruments' => 'nullable|array',
            'remarks' => 'required|string',

            // Validation For Excel and CSV files
            'xd7500_files' => 'nullable|mimes:xlsx,xls,csv',
            'sd335_files' => 'nullable|mimes:xlsx,xls,csv',
            'md610_files' => 'nullable|mimes:xlsx,xls,csv',
            'sd400_oxi_l_field' => 'nullable|mimes:xlsx,xls,csv',
            'tb350_files' => 'nullable|mimes:xlsx,xls,csv',

            // --- Validation for value + unit ---
            'ph' => 'nullable|numeric',
            'ph_unit' => 'nullable|in:pH,mV',
            'temperature' => 'nullable|numeric',
            'temperature_unit' => 'nullable|in:°C,°F',
            'conductivity' => 'nullable|numeric',
            'conductivity_unit' => 'nullable|in:μS/cm,mS/cm',
            'tds' => 'nullable|numeric',
            'tds_unit' => 'nullable|in:PPM,PPT',
            'salinity' => 'nullable|numeric',
            'salinity_unit' => 'nullable|in:PPT,PSU',

            // google recaptcha
            // 'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        $userId = $request->user_id;

        // --- Combine value + unit for instruments ---
        $fieldsWithUnits = [
            'ph' => 'ph_unit',
            'temperature' => 'temperature_unit',
            'conductivity' => 'conductivity_unit',
            'tds' => 'tds_unit',
            'salinity' => 'salinity_unit',
        ];

        foreach ($fieldsWithUnits as $field => $unitField) {
            $value = $request->input($field);
            $unit  = $request->input($unitField);

            if (!empty($value) && !empty($unit)) {
                $data[$field] = $value . ' ' . $unit;
            } else {
                $data[$field] = null;
            }
        }

        $fileFields = ['sd40_files'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                // Make a safe unique filename
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                // Store in public/uploads
                $data[$field] = $file->storeAs('uploads', $filename, 'public');
            }
        }

        // Save instruments as JSON
        if ($request->has('instruments')) {
            $data['instruments'] = json_encode($request->instruments);
        }

        AquaRoverFormData::create($data);

        if ($request->hasFile('xd7500_files')) {
            Excel::import(new usersImportExcel_XD7500($userId), $request->file('xd7500_files'));
        }
        if ($request->hasFile('sd335_files')) {
            Excel::import(new usersImportExcel_SD335($userId), $request->file('sd335_files'));
        }
        if ($request->hasFile('md610_files')) {
            Excel::import(new usersImportExcel_MD610($userId), $request->file('md610_files'));
        }
        if ($request->hasFile('sd400_oxi_l_field')) {
            Excel::import(new usersImportExcel_SD400_OXI_L($userId), $request->file('sd400_oxi_l_field'));
        }
        if ($request->hasFile('tb350_files')) {
            Excel::import(new usersImportExcel_TB350($userId), $request->file('tb350_files'));
        }

        return back()->with('success', 'Excel imported successfully!');
    }
}
