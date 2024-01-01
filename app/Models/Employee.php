<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'department_id',
        'position_id',
    ];


    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function attendance() {
        return $this->belongsTo(Attendance::class);
    }

    public function salary() {
        return $this->hasMany(Salary::class);
    }
}
