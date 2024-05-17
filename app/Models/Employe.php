<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'photo',
        'email',
        'address',
        'job_type',
        'reference',
        'salary',
    ];
}
