<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'is_active',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function employees()
    {
        return $this->hasManyThrough(
            EmployeeEmploymentInfo::class, // destination
            Position::class, // bridge
            'department_id', // positions.department_id
            'position_id', // employment_infos.position_id
            'id', // departments.id
            'id' // positions.id
        );
    }
}
