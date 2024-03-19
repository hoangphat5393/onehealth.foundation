<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = true;
    protected $table = 'sliders';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Slider::class, 'slider_id', 'id');
    }

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
