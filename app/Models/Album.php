<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'album';
    protected $guarded = [];

    public function item()
    {
        return $this->hasMany(AlbumItem::class, 'album_id')->orderBy('sort');
    }
}
