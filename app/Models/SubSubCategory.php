<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'admin_id',
        'category_id',
        'subcategory_id',
        'subsubcat_name_en',
        'subsubcat_slug_en',
    ];

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
}
