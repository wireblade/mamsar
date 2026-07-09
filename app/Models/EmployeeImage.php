<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['employee_id', 'path', 'pic', 'sig'])]
class EmployeeImage extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
