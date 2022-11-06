<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyCompany extends Model
{
    use HasFactory;

    const PER_PAGE = 10;

    protected $table = 'supply_companies';
    protected $guarded = [];
}
