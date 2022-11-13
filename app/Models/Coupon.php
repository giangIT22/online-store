<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Coupon extends Model
{
    use HasFactory, Searchable;

    const PER_PAGE = 10;
    
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'coupons_index';
    }

    public function toSearchableArray()
    {
        return [
            'coupon_name' => $this->name,
        ];
    }
}
