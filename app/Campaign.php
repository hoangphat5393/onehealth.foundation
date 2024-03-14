<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'campaign';
    protected $guarded = [];

    public function getNameAttribute($value)
    {
        $lc = app()->getLocale();
        if ('vi' == $lc) {
            return $value;
        } else {
            return $this->{'name_' . $lc};
        }
    }

    public function getDescriptionAttribute($value)
    {
        $lc = app()->getLocale();
        if ('vi' == $lc) {
            return $value;
        } else {
            return $this->{'description_' . $lc};
        }
    }
}
