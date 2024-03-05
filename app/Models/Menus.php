<?php

// namespace Harimayco\Menu\Models;
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'admin_menus';

    // public function __construct(array $attributes = [])
    // {
    //     //parent::construct( $attributes );
    //     $this->table = config('menu.table_prefix') . config('menu.table_name_menus');
    // }

    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    // public function items()
    // {
    //     return $this->hasMany('Harimayco\Menu\Models\MenuItems', 'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    // }
    public function items()
    {
        return $this->hasMany(MenuItems::class, 'menu')->with('child')->where('parent', 0)->orderBy('sort', 'ASC');
    }
}
