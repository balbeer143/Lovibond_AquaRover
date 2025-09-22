<?php

namespace App\Imports;

use App\Models\SD400_OXI_L_Excel_Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class usersImportExcel_SD400_OXI_L implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int{
        return 2;
    }
    public function model(array $row)
    {
        $excelDate = isset($row[1]) ? Date::excelToDateTimeObject($row[1])->format('Y-m-d') : null;
        $time = isset($row[2]) ? Date::excelToDateTimeObject($row[2])->format('H:i:s') : null;

        return new SD400_OXI_L_Excel_Model([
            'data_no'      => $row[0] ?? null, // Data #
            'date'         => $excelDate, // Date
            'time'         => $time, // Time
            'do_mg_l'      => $row[3] ?? null, // DO (mg/L)
            'saturation'   => $row[4] ?? null, // Saturation (%)
            'temperature'  => $row[5] ?? null, // Temperature(degC)
            'pressure'     => $row[6] ?? null, // Pressure (kPa)
        ]);
    }
}
