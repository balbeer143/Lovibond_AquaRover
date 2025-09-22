<?php

namespace App\Imports;

use App\Models\MD610_Excel_Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class usersImportExcel_MD610 implements ToModel, WithCustomCsvSettings, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 2;
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    public function model(array $row)
    {

        $excelDate = $row[0] ?? null;
        $excelTime = $row[1] ?? null;
        $datetime = null;
        $onlyTime = null;

        if ($excelDate) {
            if (is_numeric($excelDate)) {
                $dtDate = ExcelDate::excelToDateTimeObject($excelDate);
            } else {
                $dtDate = new \DateTime($excelDate);
            }

            $datetime = $dtDate->format('Y-m-d H:i:s');
        }

        if ($excelTime) {
            if (is_numeric($excelTime)) {
                $dtTime = ExcelDate::excelToDateTimeObject($excelTime);
                $onlyTime = $dtTime->format('H:i:s');
            } else {
                $dtTime = \DateTime::createFromFormat('H:i:s', $excelTime)
                    ?: \DateTime::createFromFormat('h:i:s A', $excelTime)
                    ?: new \DateTime($excelTime);
                $onlyTime = $dtTime->format('H:i:s');
            }
        }

        // dd($row);
        return new MD610_Excel_Model([
            'date' => $datetime,
            'time' => $onlyTime,
            'instrument_serial_no' => $row[2] ?? null,
            'method_no' => $row[3] ?? null,
            'method_name' => $row[4] ?? null,
            'range' => $row[5] ?? null,
            'number_of_results' => $row[6] ?? null,
            'Result_1' => $row[7] ?? null,
            'units_and_chemical_formula_1' => $row[8] ?? null,
            'Result_2' => $row[9] ?? null,
            'units_and_chemical_formula_2' => $row[10] ?? null,
            'Result_3' => $row[11] ?? null,
            'units_and_chemical_formula_3' => $row[12] ?? null,
            'Result_4' => $row[13] ?? null,
            'units_and_chemical_formula_4' => $row[14] ?? null,
            'code_no' => $row[15] ?? null,
            'current_instrument_firmware_version' => $row[16] ?? null,
            'instrument_firmware_version' => $row[17] ?? null,
        ]);
    }
}
