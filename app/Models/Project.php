<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    public $timestamps = true;

    protected $casts = [
        'salaries_total' => 'float',
        'bonus_total' => 'float',
        'payments_total' => 'float'
    ];

    protected $fillable = [
        'month',
        'salaries_payment_day',
        'bonus_payment_day',
        'salaries_total',
        'bonus_total',
        'payments_total'
    ];
}