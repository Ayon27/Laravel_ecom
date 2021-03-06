<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,  'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,  'subcategory_id', 'id');
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubcategory::class,  'subsubcategory_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class,  'product_id', 'id');
    }
}
