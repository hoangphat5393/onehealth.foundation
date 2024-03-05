<?php

namespace App\Models;

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
}
