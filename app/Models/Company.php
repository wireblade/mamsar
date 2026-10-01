<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
