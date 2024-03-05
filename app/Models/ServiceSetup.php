<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSetup extends Model
{
    public $timestamps = true;
    protected $table = 'service_setup';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'service_category', 'service_id', 'category_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
