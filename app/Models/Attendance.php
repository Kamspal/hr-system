<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use Uuids;

    protected $fillable = [
        'in_time',
        'out_time', 
        'days_worked',
        'employee_id'
        ];
        

    public function employee() {
        return $this->hasMany(Employee::class);
    }

}
