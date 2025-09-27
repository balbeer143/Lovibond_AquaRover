<?php

namespace App\Http\Controllers;

use App\Exports\masterSheetExcelImport;
use App\Models\MD610_Excel_Model;
use App\Models\SD400_OXI_L_Excel_Model;
use App\Models\XD7500_Excel_Model;
use Illuminate\Http\Request;
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

        // Agar dates empty hain, default aaj ka use karo
        $from = $request->from_date ?: date('Y-m-d');
        $to   = $request->to_date ?: date('Y-m-d');

        $mergeData = [];

        $xd7500 = XD7500_Excel_Model::select('method', 'value', 'unit')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        $md610 = MD610_Excel_Model::select('method_no', 'method_name', 'Result_1', 'units_and_chemical_formula_1')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        $sd400 = SD400_OXI_L_Excel_Model::select('do_mg_l')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        $max = max($xd7500->count(), $md610->count(), $sd400->count());

        for ($i = 0; $i < $max; $i++) {
            $mergeData[] = [
                'method' => $xd7500[$i]->method ?? '',
                'value' => $xd7500[$i]->value ?? '',
                'unit' => $xd7500[$i]->unit ?? '',
                'method_no' => $md610[$i]->method_no ?? '',
                'method_name' => $md610[$i]->method_name ?? '',
                'Result_1' => $md610[$i]->Result_1 ?? '',
                'units_and_chemical_formula_1' => $md610[$i]->units_and_chemical_formula_1 ?? '',
                'do_mg_l' => $sd400[$i]->do_mg_l ?? '',
            ];
        }

        $format = $request->format ?: 'xlsx';
        $extension = $format === 'csv' ? 'csv' : 'xlsx';

        $writerType = $format === 'csv' ? ExcelWriter::CSV : ExcelWriter::XLSX;

        $filename = $from === $to
            ? "daily_data_{$from}.{$extension}"
            : "data_{$from}_to_{$to}.{$extension}";

        return Excel::download(new masterSheetExcelImport($mergeData), $filename, $writerType);
    }
}
