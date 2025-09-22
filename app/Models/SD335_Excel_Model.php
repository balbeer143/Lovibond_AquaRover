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
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
