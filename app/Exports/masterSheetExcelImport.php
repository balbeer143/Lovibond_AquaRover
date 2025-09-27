<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class masterSheetExcelImport implements FromCollection, WithHeadings
{
    protected $data;

    // Constructor me data pass karo
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Array ko Collection me convert karo
        return new Collection($this->data);
    }

    public function headings(): array
    {
        // Agar data empty nahi hai toh first row ke keys ko headings use karo
        return count($this->data) ? array_keys($this->data[0]) : [];
    }
}
