<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Salary extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = [
        'employee_id',
        'amount',
        'pay',
        'due',
        'note',
        'designation',
        'status'
    ];
    public function relationWithUser(){
        return $this->hasOne(User::class,'id','employee_id');
    }
    public function relationWithEmployee(){
        return $this->hasOne(Employe::class,'id','employee_id');
    }





}
