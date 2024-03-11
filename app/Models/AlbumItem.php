<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumItem extends Model
{
    use HasFactory;

    public $timestamps = false;
    // protected $table = 'album';
    protected $guarded = [];
}
