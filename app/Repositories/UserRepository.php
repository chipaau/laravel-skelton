<?php

namespace App\Repositories;

use Chipaau\Repositories\Repository;
use App\User;

/**
* User repository
*/
class UserRepository extends Repository
{
    protected function model()
    {
        return User::class;
    }
}