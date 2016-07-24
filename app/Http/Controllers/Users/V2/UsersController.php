<?php

namespace App\Http\Controllers\V2;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepository;
use Chipaau\Controllers\Controller AS CoreController;

class UsersController extends CoreController
{

    public function __construct(UserRepository $userRepository)
    {
        dd('v2 controller');
        parent::__construct($userRepository);
    }
}
