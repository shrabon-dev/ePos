<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function relationWithTax(){
        return $this->hasOne(Tax::class,'id','tax');
    }
    public function relationWithBrand(){
        return $this->hasOne(Brand::class,'id','brand');
    }
    public function relationWithCategory(){
        return $this->hasOne(Category::class,'id','category');
    }
}
