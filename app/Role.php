<?php

namespace App;

use App\User;
use Chipaau\Database\Eloquent\Model;

class Role extends Model
{

    const FIELD_NAME = 'name';
    const FIELD_CREATED_AT = self::CREATED_AT;

    /** Field name */
    const FIELD_UPDATED_AT = self::UPDATED_AT;

    protected $casts = [
        self::FIELD_CREATED_AT => 'datetime',
        self::FIELD_UPDATED_AT => 'datetime'
    ];

    public function relations()
    {
        return [
            'user'
        ];
    }

    public function mappings()
    {
        return [
            'name' => 'role_name'
        ];
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
