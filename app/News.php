<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Category;

class News extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id';

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'post_category', 'post_id', 'category_id');
    }

    public function getTitleAttribute($value)
    {
        $lc = app()->getLocale();
        if ('vi' == $lc) {
            return $value;
        } else {
            return $this->{'name_' . $lc};
        }
    }

    public function getDescriptionAttribute($value)
    {
        $lc = app()->getLocale();
        if ('vi' == $lc) {
            return $value;
        } else {
            return $this->{'description_' . $lc};
        }
    }

    public function getContentAttribute($value)
    {
        $lc = app()->getLocale();
        if ('vi' == $lc) {
            return $value;
        } else {
            return $this->{'content_' . $lc};
        }
    }
}
