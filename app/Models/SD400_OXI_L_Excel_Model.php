<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SD400_OXI_L_Excel_Model extends Model
{
   protected $table = 'SD400_OXI_L_sheet_data';
    protected $fillable = [
        'data_no',
        'date',
        'time',
        'do_mg_l',
        'saturation',
        'temperature',
        'pressure',
    ];
}
