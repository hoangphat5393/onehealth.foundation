<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'campaign';
    protected $guarded = [];

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'campaign_category', 'campaign_id', 'category_id');
    // }
}
