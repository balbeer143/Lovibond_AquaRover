<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XD7500_Excel_Model extends Model
{

    protected $table = 'xd7500_sheet_data';
    protected $fillable = [
        'memory_id',
        'date_time',
        'value_id',
        'user',
        'method',
        'cell',
        'value',
        'unit',
        'citation',
        'dilution_1x',
        'aqa1_id',
        'aqa2_id',
        'matrixcheck_id',
        'reference_sample_blank',
        'blank',
        'date_of_blank',
        'lot_id',
        'measured_absorbance',
        'cal_id',
        'mq',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
