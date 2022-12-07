<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    const PER_PAGE = 9;
    const SEARCH_PRODUCT = 8;
    const RELATED_PRODUCT = 6;
    const NO_PUBLIC = 1;
    const PUBLIC = 2;

    const status = [
        self::NO_PUBLIC => 'Chưa bán',
        self::PUBLIC => 'Đang bán'
    ];

    //filter values
    const FILTER_VALUES = [
        '<500000',
        '500000-1000000',
        '1000000-2000000',
        '2000000-3000000',
        '>3000000'
    ];

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'products_index';
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'product_code' => $this->product_code
        ];
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_details', 'product_id', 'size_id')->withPivot ('amount');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_details', 'product_id', 'color_id')->withPivot ('amount');
    }
}
