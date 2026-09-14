<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['employee_id', 'position', 'company', 'department', 'employment_status', 'immediate_supervisor', 'date_hired'])]

class EmployeeEmploymentInfo extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
