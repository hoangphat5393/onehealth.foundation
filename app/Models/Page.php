<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $timestamps = true;
    protected $table = 'page';
    protected $guarded = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
