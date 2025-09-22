<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TB350_Excel_Model extends Model
{
    protected $table = 'tb350_sheet_data';
    protected $fillable = [
        'datetime',
        'initials',
        'notes',
        'measurement',
        'location',
        'mode',
        'sample_id',
        'signal_average_readings',
         'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
