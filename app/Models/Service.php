<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\ServiceSetup;

class Service extends Model
{
    public $timestamps = true;
    protected $table = 'service';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'service_category', 'service_id', 'category_id');
    }

    public function setups()
    {
        return $this->hasMany(ServiceSetup::class);
    }
}
