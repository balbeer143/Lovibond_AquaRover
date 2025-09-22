<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MD610_Excel_Model extends Model
{
    protected $table = 'md610_sheet_data';

    protected $fillable = [
        'date',
        'time',
        'instrument_serial_no',
        'method_no',
        'method_name',
        'range',
        'number_of_results',
        'Result_1',
        'units_and_chemical_formula_1',
        'Result_2',
        'units_and_chemical_formula_2',
        'Result_3',
        'units_and_chemical_formula_3',
        'Result_4',
        'units_and_chemical_formula_4',
        'code_no',
        'current_instrument_firmware_version',
        'instrument_firmware_version',
    ];
}
