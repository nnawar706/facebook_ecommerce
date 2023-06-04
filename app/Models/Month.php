<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $guarded = [
        'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function salary_data()
    {
        return $this->hasMany(EmployeeSalary::class);
    }
}
