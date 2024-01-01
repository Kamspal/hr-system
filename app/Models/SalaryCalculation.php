<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryCalculation extends Model
{
    protected $fillable = [
        'calculation_date',
        'employee_id',
        'status',
        'salary_amount'
    ];
}
