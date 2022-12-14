<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory, Searchable;

    const PER_PAGE = 10;
    
    const PENDING = 0;
    const CONFIRMED = 1;
    const SHIPPING = 2;
    const DELIVERED = 3;
    const REQUEST_CANCEL = 4;
    const CANCELED = 5;
    const RETEURNED = 6;

    const PAID = 1;
    
    protected $guarded = [];

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'orders_index';
    }

    public function toSearchableArray()
    {
        return [
            'order_code' => $this->order_code,
        ];
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function order_item()
    {
        return $this->hasMany(OrderItem::class);
    }
}
