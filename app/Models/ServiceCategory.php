<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LocalizeController;


class ServiceCategory extends Model
{
    use LocalizeController;

    public $timestamps = true;
    protected $table = 'service_category';
    protected $guarded = [];
}
