<?php

namespace App\Imports;

use App\Models\XD7500_Excel_Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class usersImportExcel_XD7500 implements ToModel, WithHeadingRow, WithCustomCsvSettings
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
        return new XD7500_Excel_Model([
            'memory_id'             => $row['memory_id'] ?? null,
            'date_time'             => $row['date_time'] ?? null,
            'value_id'              => $row['value_id'] ?? null,
            'user'                  => $row['user'] ?? null,
            'method'                => $row['method'] ?? null,
            'cell'                  => $row['cell'] ?? null,
            'value'                 => $row['value'] ?? null,
            'unit'                  => $row['unit'] ?? null,
            'citation'              => $row['citation'] ?? null,
            'dilution_1x'           => $row['dilution_1x'] ?? null,
            'aqa1_id'               => $row['aqa1_id'] ?? null,
            'aqa2_id'               => $row['aqa2_id'] ?? null,
            'matrixcheck_id'        => $row['matrixcheck_id'] ?? null,
            'reference_sample_blank'=> $row['reference_sample_blank'] ?? null,
            'blank'                 => $row['blank'] ?? null,
            'date_of_blank'         => $row['date_of_blank'] ?? null,
            'lot_id'                => $row['lot_id'] ?? null,
            'measured_absorbance'   => $row['measured_absorbance'] ?? null,
            'cal_id'                => $row['cal_id'] ?? null,
            'mq'                    => $row['mq'] ?? null,
        ]);
    }
}
