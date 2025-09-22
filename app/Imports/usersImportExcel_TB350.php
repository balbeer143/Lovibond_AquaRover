<?php

namespace App\Imports;

use App\Models\TB350_Excel_Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class usersImportExcel_TB350 implements ToModel, WithStartRow
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
    public function model(array $row)

    {
        if (empty(array_filter($row))) {
            return null;
        }

        $dateTime = null;
        if (!empty($row[0])) {
            if (is_numeric($row[0])) {
                $dateTime = Date::excelToDateTimeObject($row[0])->format('Y-m-d H:i:s');
            } else {
                $parsed = \DateTime::createFromFormat('m-d-Y h:i A', $row[0]);
                if (!$parsed) {
                    $parsed = \DateTime::createFromFormat('m-d-Y H:i', $row[0]);
                }
                if ($parsed) {
                    $dateTime = $parsed->format('Y-m-d H:i:s');
                }
            }
        }

        return new TB350_Excel_Model([
            'datetime'                 => $dateTime,
            'initials'                 => $row[1] ?? null,
            'notes'                    => $row[2] ?? null,
            'measurement'              => $row[3] ?? null,
            'location'                 => $row[4] ?? null,
            'mode'                     => $row[5] ?? null,
            'sample_id'                => $row[6] ?? null,
            'signal_average_readings'  => $row[7] ?? null,
            'user_id'               => $this->userId,
        ]);
    }
}
