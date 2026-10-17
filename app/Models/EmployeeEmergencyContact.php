<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['employee_id', 'contact_name', 'contact_number', 'relation'])]

class EmployeeEmergencyContact extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
