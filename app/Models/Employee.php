<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    public $timestamps = true;

    protected $casts = [
        'salary' => 'float',
        'bonus_percent' => 'float'
    ];

    protected $fillable = [
        'name',
        'salary',
        'bonus_percent'
    ];
}