<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use Uuids;

    protected $fillable = [
        'name',
        'department_id'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function employee() {
        return $this->hasMany(Employee::class);
    }

    public function salary() {
        return $this->hasOne(Salary::class);
    }
}
