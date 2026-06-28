<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id', 'name', 'email', 'phone', 'photo',
        'gender', 'date_of_birth', 'joining_date',
        'department', 'designation', 'shift',
        'basic_salary', 'nid', 'address', 'status',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function todayAttendance()
    {
        return $this->hasOne(Attendance::class)
                    ->whereDate('date', today());
    }
}