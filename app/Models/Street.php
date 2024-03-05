<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public $timestamps = false;
    protected $table = 'street';
    protected $fillable = [
        'name',
        'prefix',
        'district_id',
        'province_id'
    ];
}
