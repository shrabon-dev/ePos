<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id',
                        'customer_phone',
                        'payment_system',
                        'sale_by',
                        'payment_status',
                        'order_status',
                        'due',
                        'paid',
                        'sub_total',
                        'total_discount',
                        'total_tax',
                        'total_price'];
    public function relationWithCustomer(){
       return $this->hasOne(User::class,'id','customer_id');
    }
    public function relationWithSaleBy(){
       return $this->hasOne(User::class,'id','sale_by');
    }
}
