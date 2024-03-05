<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LocalizeController;

class Contact extends Model
{
    use LocalizeController;

    public $timestamps = true;
    protected $table = 'contact';
    protected $guarded = [];
}
