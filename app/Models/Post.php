<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'post';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
