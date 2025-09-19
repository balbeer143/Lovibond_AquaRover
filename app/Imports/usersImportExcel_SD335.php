<?php

namespace App\Imports;

use App\Models\SD335_Excel_Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class usersImportExcel_SD335 implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    public function model(array $row)
    {
        return new SD335_Excel_Model([
            'timestamp' => $row['timestamp_utc'] ?? null,
            'value' => $row['value'] ?? null,
            'unit' => $row['unit'] ?? null,
            'location' => $row['location'] ?? null,
        ]);
    }
}
