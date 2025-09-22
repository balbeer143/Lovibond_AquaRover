<?php

namespace App\Imports;

use App\Models\XD7500_Excel_Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;

class usersImportExcel_XD7500 implements ToModel, WithCustomCsvSettings, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

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
        // dd($this->userId);
        return new XD7500_Excel_Model([
            'memory_id'             => $row[0] ?? null,
            'date_time'             => $row[1] ?? null,
            'value_id'              => $row[2] ?? null,
            'user'                  => $row[3] ?? null,
            'method'                => $row[4] ?? null,
            'cell'                  => $row[5] ?? null,
            'value'                 => $row[6] ?? null,
            'unit'                  => $row[7] ?? null,
            'citation'              => $row[8] ?? null,
            'dilution_1x'           => $row[9] ?? null,
            'aqa1_id'               => $row[10] ?? null,
            'aqa2_id'               => $row[11] ?? null,
            'matrixcheck_id'        => $row[12] ?? null,
            'reference_sample_blank' => $row[13] ?? null,
            'blank'                 => $row[14] ?? null,
            'date_of_blank'         => $row[15] ?? null,
            'lot_id'                => $row[16] ?? null,
            'measured_absorbance'   => $row[17] ?? null,
            'cal_id'                => $row[18] ?? null,
            'mq'                    => $row[19] ?? null,
            'user_id'               => $this->userId,
        ]);
    }
}