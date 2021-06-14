<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManagement extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'product_description', 'product_image', 'category_id'];

    public function categoryname(){
     return $this->hasOne(CategoryManagement::class,'id','category_id');
    }
}
