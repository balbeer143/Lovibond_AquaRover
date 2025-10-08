<?php

namespace App\Http\Controllers;

use App\Exports\masterSheetExcelImport;
use App\Models\AquaRoverFormData;
use App\Models\MD610_Excel_Model;
use App\Models\SD400_OXI_L_Excel_Model;
use App\Models\XD7500_Excel_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelWriter;

class dataExportController extends Controller
{

    // View page with From/To date
    public function viewDateRange()
    {
        return view('download-master-sheet');
    }

    // Export data by date range
    public function exportDateRange(Request $request)
    {

        $request->validate([
            'from_date' => 'nullable|date',
            'to_date'   => 'nullable|date|after_or_equal:from_date',
            'format'    => 'nullable|in:xlsx,csv', // ✅ validate format
        ]);

        $from = $request->from_date ?: date('Y-m-d');
        $to   = $request->to_date ?: date('Y-m-d');

        $user = Auth::user();

        // dd($user);

        $mergeData = [];

        // XD7500
        if ($user && $user->role === 'admin') {
            $xd7500 = XD7500_Excel_Model::select('method', 'value', 'unit')
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        } else {
            $xd7500 = XD7500_Excel_Model::select('method', 'value', 'unit')
                ->where('user_id', $user->id)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        }

        // MD610
        if ($user && $user->role === 'admin') {
            $md610 = MD610_Excel_Model::select('method_no', 'method_name', 'Result_1', 'units_and_chemical_formula_1')
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        } else {
            $md610 = MD610_Excel_Model::select('method_no', 'method_name', 'Result_1', 'units_and_chemical_formula_1')
                ->where('user_id', $user->id)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        }

        // SD400
        if ($user && $user->role === 'admin') {
            $sd400 = SD400_OXI_L_Excel_Model::select('do_mg_l')
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        } else {
            $sd400 = SD400_OXI_L_Excel_Model::select('do_mg_l')
                ->where('user_id', $user->id)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        }

        // SD40
        if ($user && $user->role === 'admin') {
            $sd40 = AquaRoverFormData::select('ph', 'temperature', 'conductivity', 'tds', 'salinity')
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        } else {
            $sd40 = AquaRoverFormData::select('ph', 'temperature', 'conductivity', 'tds', 'salinity')
                ->where('user_id', $user->id)
                ->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to)
                ->get();
        }

        $max = max($xd7500->count(), $md610->count(), $sd400->count(), $sd40->count());

        for ($i = 0; $i < $max; $i++) {
            $mergeData[] = [

                // XD7500
                'XD7500_method' => $xd7500[$i]->method ?? '',
                'XD7500_value'  => $xd7500[$i]->value ?? '',
                'XD7500_unit'   => $xd7500[$i]->unit ?? '',

                // MD610
                'MD610_method_no'   => $md610[$i]->method_no ?? '',
                'MD610_method_name' => $md610[$i]->method_name ?? '',
                'MD610_Result_1'    => $md610[$i]->Result_1 ?? '',
                'MD610_units_and_chemical_formula_1' => $md610[$i]->units_and_chemical_formula_1 ?? '',

                // SD400
                'SD400_do_mg_l' => $sd400[$i]->do_mg_l ?? '',

                // SD40
                'SD40_ph' => $sd40[$i]->ph ?? '',
                'SD40_temperature' => $sd40[$i]->temperature ?? '',
                'SD40_conductivity' => $sd40[$i]->conductivity ?? '',
                'SD40_tds' => $sd40[$i]->tds ?? '',
                'SD40_salinity' => $sd40[$i]->salinity ?? '',

            ];
        }

        if (!$mergeData) {
            return redirect()->back()->with('error', 'No data found for the selected date range.');
        }

        $columnsWithData = [];
        foreach ($mergeData as $row) {
            foreach ($row as $key => $value) {
                if (!empty($value)) {
                    $columnsWithData[$key] = true;
                }
            }
        }

        $filteredData = [];
        foreach ($mergeData as $row) {
            $filteredData[] = array_intersect_key($row, $columnsWithData);
        }

        $format = $request->format ?: 'xlsx';
        $extension = $format === 'csv' ? 'csv' : 'xlsx';

        $writerType = $format === 'csv' ? ExcelWriter::CSV : ExcelWriter::XLSX;

        $prefix = $user->role === 'admin' ? "All_Users" : "";

        $filename = $from === $to
            ? "{$prefix}Today_Data_{$from}.{$extension}"
            : "{$prefix}Selected_Date_Data_{$from}_to_{$to}.{$extension}";

        $dateTime  = $from === $to ? $from : $from . ' to ' . $to;

        return Excel::download(
            new masterSheetExcelImport(
                $filteredData,
                $user->name ?? 'Unknown User',
                $user->mobile ?? 'N/A',
                $user->email ?? 'N/A',
                $user->department ?? 'N/A',
                $dateTime
            ),
            $filename,
            $writerType
        );
    }
}
