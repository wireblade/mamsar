<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['fname', 'mname', 'lname', 'position', 'empId', 'address', 'suffix', 'dob', 'status'])]

class Employee extends Model
{
    use HasFactory;

    public function govid()
    {
        return $this->hasOne(EmployeeGovernmentId::class);
    }

    public function emergency()
    {
        return $this->hasOne(EmployeeEmergencyContact::class);
    }

    public function image()
    {
        return $this->hasOne(EmployeeImage::class);
    }
}
