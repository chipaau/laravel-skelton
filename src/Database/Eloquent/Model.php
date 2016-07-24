<?php

namespace Chipaau\Database\Eloquent;

use Illuminate\Database\Eloquent\Model AS EloquentModel;

/**
* Base model
*/
abstract class Model extends EloquentModel
{
    abstract function relations();
    abstract function mappings();
}