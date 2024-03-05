<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_register_email extends Model
{
    protected $table = 'user_register_email';
    protected $fillable = [
        'id',
        'email',
        'created_at',
        'updated_at',
    ];
}
