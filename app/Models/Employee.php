<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'email',
        'phone_no',
        'image_url',
        'address',
        'city_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function salary_data()
    {
        return $this->hasMany(EmployeeSalary::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
