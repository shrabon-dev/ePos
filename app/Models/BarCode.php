<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarCode extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','quantity'];
    function realtionWithProduct(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
