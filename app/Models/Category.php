<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'popular',
        'image',
        'meta_title',
        'meta_description',
        'meta_keyword'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }

    public function getImageUrlAttribute()
    {
        if (!empty($this->image) &&
            file_exists(public_path('upload/category/' . $this->image))) {
            return asset('upload/category/' . $this->image);
        }

        return asset('upload/category/placeholder_image.jpg');
    }
}
