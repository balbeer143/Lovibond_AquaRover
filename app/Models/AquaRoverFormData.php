<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AquaRoverFormData extends Model
{
    protected $table = 'aquarover_form_data';

    protected $fillable = [
        'user_id','name','tested_by','mobile','email','address','state',
        'city','village','latitude','longitude','location_screenShot',
        'sample_type','source_category','date','time','instruments',
        'xd7500_files','sd335_files','md610_files','tb350_files',
        'sd400_oxi_l_field','ph','temperature','conductivity',
        'tds','salinity','sd40_files','remarks'
    ];

    // Cast instruments to JSON
    protected $casts = [
        'instruments' => 'array',
    ];
}
