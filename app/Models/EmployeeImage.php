<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['employee_id', 'picture_path', 'signature_path'])]
class EmployeeImage extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
