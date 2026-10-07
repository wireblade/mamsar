<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function positions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Position::class,
            Department::class
        );
    }
}
