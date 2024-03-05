<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $timestamps     = true;
    public $table          = 'field';
    protected $guarded     = [];
}
