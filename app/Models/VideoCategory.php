<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LocalizeController;


class VideoCategory extends Model
{
    use LocalizeController;

    public $timestamps = true;
    protected $table = 'video_category';
    protected $guarded = [];
}
