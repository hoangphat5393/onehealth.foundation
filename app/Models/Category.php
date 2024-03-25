<?php

namespace App\Models;

// use App\Enums\ServerStatus;
// use App\Enums\UserRole;
// use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Casts\Attribute;
// use Illuminate\Database\Eloquent\Casts\AsStringable;
// use Illuminate\Database\Eloquent\Casts\AsArrayObject;
// use Illuminate\Database\Eloquent\Casts\AsCollection;
// use App\Collections\OptionCollection;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LocalizeController;
// use DateTimeInterface;

class Category extends Model
{
    // use LocalizeController;
    // use HasFactory;

    /**
     * Prepare a date for array / JSON serialization.
     */
    // protected function serializeDate(DateTimeInterface $date): string
    // {
    //     return $date->format('Y-m-d');
    // }

    public $timestamps = true;
    protected $table = 'category';
    protected $guarded = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    // protected $attributes = [
    //     'options' => '[]',
    //     'delayed' => false,
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $cast = [
    //     'options' => 'array',                // change option to column want to cast to array
    //     'options' => AsArrayObject::class,   // casts your JSON attribute to an ArrayObject class
    //     'options' => AsCollection::class,    // casts your JSON attribute to a Laravel Collection instance
    //     'is_admin' => 'boolean',             // the is_admin attribute will always be cast to a boolean when you access it
    //     'directory' => AsStringable::class,  // cast a model attribute to a fluent Illuminate\Support\Stringable object:
    //     'created_at' => 'datetime:Y-m-d',    // When defining a date or datetime cast, you may also specify the date's format
    //     'status' => ServerStatus::class,     // cast your attribute values to PHP Enums
    //     'statuses' => AsEnumCollection::class.':'.ServerStatus::class     // Casting Arrays of Enums
    // ];


    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent', 'id')->orderBy('sort');
    }

    // public function children_type($type)
    // {
    //     return $this->hasMany(Category::class, 'parent', 'id')->where('type', $type)->orderBy('sort');
    // }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
