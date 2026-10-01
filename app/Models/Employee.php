<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['fname', 'mname', 'lname', 'address', 'suffix', 'dob', 'marital_status'])]

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

    public function empinfo()
    {
        return $this->hasOne(EmployeeEmploymentInfo::class);
    }
}
