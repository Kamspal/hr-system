<?php

namespace App\Models;

use App\Traits\Uuids;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Uuids;

    protected $fillable = [
        'name',
    ];

    public function position() {
        return $this->hasMany(Position::class);
    }

    public function employee() {
        return $this->hasMany(Employee::class);
    }

    public function salary() {
        return $this->hasMany(Salary::class);
    }
}
