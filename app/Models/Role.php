<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    const ADMIN = 1;
    const EMPLOYEE = 2;

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
