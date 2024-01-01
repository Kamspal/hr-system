<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'basic_salary',
        'hra',
        'da',
        'other_allowances',
        'gross_salary',
        'position_id'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function employee() {
        return $this->belongsTo(Salary::class);
    }
}
