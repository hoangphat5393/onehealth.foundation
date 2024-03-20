<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shortcode extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'shortcode';
    protected $guarded = [];
}
