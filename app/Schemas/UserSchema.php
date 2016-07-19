<?php

namespace App\Schemas;

use App\User;

/**
 * @package Neomerx\LimoncelloIlluminate
 */
class UserSchema extends Schema
{
    /** Type */
    const TYPE = 'users';

    /** Model class name */
    const MODEL = User::class;

    /** Attribute name */
    const ATTR_NAME = 'name';

    /**
     * @inheritdoc
     */
    protected function getSchemaMappings()
    {
        return [
            self::IDX_TYPE => self::TYPE,

            self::IDX_ATTRIBUTES => [
                self::ATTR_NAME       => User::FIELD_NAME,
                self::ATTR_CREATED_AT => User::FIELD_CREATED_AT,
                self::ATTR_UPDATED_AT => User::FIELD_UPDATED_AT,
            ],

        ];
    }
}