<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPasswordAuto extends Model
{
    public $timestamps = true;
    protected $table = 'user_password_auto';
    protected $guarded = [];
}
