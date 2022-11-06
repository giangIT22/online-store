<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    const PER_PAGE = 10;
    const BLOG_SLIDER = 6;
    const BLOG_PAGE = 3;
}
