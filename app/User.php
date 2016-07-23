<?php

namespace App;

use Chipaau\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    /** Field name */
    const FIELD_NAME = 'name';

    const FIELD_CREATED_AT = self::CREATED_AT;

    /** Field name */
    const FIELD_UPDATED_AT = self::UPDATED_AT;

    protected $casts = [
        self::FIELD_CREATED_AT => 'datetime',
        self::FIELD_UPDATED_AT => 'datetime'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'is_confirmed', 'is_active', 'is_blacklisted' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
