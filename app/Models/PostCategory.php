<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LocalizeController;

class PostCategory extends Model
{
    use LocalizeController;

    public $timestamps = true;
    protected $table = 'post_category';
    protected $guarded = [];
}
