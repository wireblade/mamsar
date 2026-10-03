<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'code',
        'name',
        'address',
        'description',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
