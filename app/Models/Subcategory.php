<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'admin_id',
        'category_id',
        'subcat_name_en',
        'subcat_slug_en',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,  'category_id', 'id');
    }

    public function subsubcategory()
    {
        return $this->hasMany(SubSubCategory::class);
    }
}
