<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating_Product extends Model
{
    protected $table = 'rating_product';
    protected $fillable = [
        'id',
        'id_product',
        'user_id',
        'rating',
        'rating_content',
        'link_product',
        'created_at',
        'updated_at'
    ];

    public function theme()
    {
        return $this->belongsTo('App\Models\Theme', 'pro_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
