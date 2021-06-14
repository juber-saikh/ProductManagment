<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryManagement extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'category_image', 'parent_category'];

    public function getProfileImageAttribute($value)
    {
        if(!empty($value)) {
            return asset($value);
        }
    }
}
