<?php

namespace App\Schemas;

use App\Role;

/**
 * @package Neomerx\LimoncelloIlluminate
 */
class RoleSchema extends Schema
{
    /** Type */
    const TYPE = 'roles';

    /** Model class name */
    const MODEL = Role::class;

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
                self::ATTR_NAME       => ROle::FIELD_NAME,
                self::ATTR_CREATED_AT => ROle::FIELD_CREATED_AT,
                self::ATTR_UPDATED_AT => ROle::FIELD_UPDATED_AT,
            ],

        ];
    }
}