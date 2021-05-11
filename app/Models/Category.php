<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    /**
     * Get the category image.
     */
    protected $guarded = [];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function parent()
    {
    return $this->belongsTo(self::class, 'parent_id');

    }
    public function subcategory(){
        return $this->hasMany(self::class, 'parent_id');
    }
    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }
}
