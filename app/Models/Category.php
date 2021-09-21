<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'admin_id',
        'category_name_en',
        'category_slug_en',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function subsubcategory()
    {
        return $this->hasMany(SubSubCategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
