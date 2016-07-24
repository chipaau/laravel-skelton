<?php

namespace App;

use App\Role;
use Chipaau\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    /** Field name */
    const FIELD_NAME = 'name';

    const FIELD_CREATED_AT = self::CREATED_AT;

    /** Field name */
    const FIELD_UPDATED_AT = self::UPDATED_AT;

    const REL_ROLES = 'roles';

    protected $casts = [
        self::FIELD_CREATED_AT => 'datetime',
        self::FIELD_UPDATED_AT => 'datetime'
    ];

    public function relations()
    {
        return [
            'rules'
        ];
    }

    public function mappings()
    {
        return [
            'name' => 'user_name',
            'email' => 'email_address',
            'phone' => 'phone_number'
        ];
    }
    
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

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
