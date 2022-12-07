<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Receipt extends Model
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
        return 'receipts_index';
    }

    public function toSearchableArray()
    {
        return [
            'receipt_code' => $this->order_code,
        ];
    }
}
