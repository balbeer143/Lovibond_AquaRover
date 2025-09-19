<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SD335_Excel_Model extends Model
{
    protected $table = 'sd335_sheet_data';

    protected $fillable = [
        'timestamp',
        'value',
        'unit',
        'location',
    ];
}
