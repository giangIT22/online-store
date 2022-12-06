<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    const PER_PAGE = 10;
    const WORKING = 1;
    const NO_WORKING = 2;
    
    const STATUES = [
        self::WORKING => 'Đang làm',
        self::NO_WORKING => 'Đã nghỉ'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address', 'phone', 'cccd',
        'profile_photo_path', 'role_id', 'status', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'employees_index';
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
