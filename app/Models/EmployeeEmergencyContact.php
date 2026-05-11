<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['employee_id', 'contact_name', 'contact_number'])]

class EmployeeEmergencyContact extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
