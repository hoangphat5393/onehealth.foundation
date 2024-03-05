<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingCost extends Model
{
    public $timestamps = false;
    protected $table = 'settings_cost';
    protected $guarded = [];
}
