<?php

namespace App\Imports;

use App\Models\SD335_Excel_Model;
use Laravel\Sail\Console\PublishCommand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class usersImportExcel_SD335 implements ToModel, WithCustomCsvSettings, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int{
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
        return new SD335_Excel_Model([
            'timestamp' => $row[0] ?? null,  // timestamp_utc
            'value'     => $row[1] ?? null,  // value
            'unit'      => $row[2] ?? null,  // unit
            'location'  => $row[3] ?? null,  // location
        ]);
    }
}
