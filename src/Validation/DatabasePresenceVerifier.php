<?php

namespace Chipaau\Validation;

use Illuminate\Validation\DatabasePresenceVerifier AS IlluminateDatabasePresenceVerifier;

/**
 * database presence varifer for database related validations
 * @author Ahmed Shifau <chipaau@chipaau.com>
 */
class DatabasePresenceVerifier extends IlluminateDatabasePresenceVerifier
{

    /**
     * Count the number of objects in a collection having the given value.
     *
     * @param  string  $collection
     * @param  string  $column
     * @param  string  $value
     * @param  int     $excludeId
     * @param  string  $idColumn
     * @param  array   $extra
     * @return int
     */
    public function getRowCount($table, $column, $value, $excludeId = null, $idColumn = null, array $extra = array(), $data = [])
    {
        $query = $this->table($table)->where($column, '=', $value);

        if (! is_null($excludeId) && $excludeId != 'NULL') {
            $query->where($idColumn ?: 'id', '<>', $excludeId);
        }

        foreach ($extra as $key => $extraValue) {
            if (! array_key_exists($extraValue, $data)) {
                throw new \Exception("$extraValue does not exists in input.", 1);
            }
            
            $this->addWhere($query, $key, $data[$extraValue]);
        }

        return $query->count();
    }

    /**
     * Count the number of objects in a collection with the given values.
     *
     * @param  string  $table
     * @param  string  $column
     * @param  array   $values
     * @param  array   $extra
     * @return int
     */
    public function getMultiRowCount($table, $column, array $values, array $extra = array(), $data = [])
    {
        $query = $this->table($table)->whereIn($column, $values);

        foreach ($extra as $key => $extraValue) {
            if (! array_key_exists($extraValue, $data)) {
                throw new \Exception("$extraValue does not exists in input.", 1);
            }
            
            $this->addWhere($query, $key, $data[$extraValue]);
        }

        return $query->count();
    }
}