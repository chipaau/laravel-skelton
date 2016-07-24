<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Chipaau\Controllers\Controller AS CoreController;

class UsersController extends CoreController
{

    public function setRepository()
    {
        return UserRepository::class;
    }

    public function setRequest()
    {
        return UserRequest::class;
    }
}
