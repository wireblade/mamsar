<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['employee_id', 'position_id', 'id_number', 'department', 'employment_status', 'immediate_supervisor', 'date_hired'])]

class EmployeeEmploymentInfo extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
