<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'video_category', 'video_id', 'category_id');
    }
}
