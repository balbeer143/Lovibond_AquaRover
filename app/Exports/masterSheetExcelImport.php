<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class masterSheetExcelImport implements FromCollection, WithHeadings
{
    protected $data;
    protected $username;
    protected $mobile;
    protected $email;
    protected $department;
    protected $dateTime;

    public function __construct(array $data, string $username, string $mobile, string $email, string $department = '', string $dateTime = '')
    {
        $this->data       = $data;
        $this->username   = $username;
        $this->mobile     = $mobile;
        $this->email      = $email;
        $this->department = $department;
        $this->dateTime   = $dateTime;
    }

    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        $headings = !empty($this->data) ? array_keys($this->data[0]) : [];

        return [
            ["Water Testing Report"],
            ["User Name: " . $this->username],
            ["Mobile Number: " . $this->mobile],
            ["Email ID: " . $this->email],
            ["Department: " . $this->department],
            ["Date: " . $this->dateTime],
            [],
            $headings,
        ];
    }
}
