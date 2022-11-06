<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PER_PAGE = 10;
    
    const PENDING = 0;
    const CONFIRMED = 1;
    const SHIPPING = 2;
    const DELIVERED = 3;
    const REQUEST_CANCEL = 4;
    const CANCELED = 5;

    const PAID = 1;
    
    protected $guarded = [];

}
