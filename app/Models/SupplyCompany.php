<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SupplyCompany extends Model
{
    use HasFactory, Searchable;

    const PER_PAGE = 10;

    protected $table = 'supply_companies';
    protected $guarded = [];
    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'supply_companies_index';
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
