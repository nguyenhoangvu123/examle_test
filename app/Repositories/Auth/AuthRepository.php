<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Auth\AuthRepositoryInterface;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUser($fileds)
    { 
        return $this->model->where('email' , $fileds['email'])->first();
    }
    
}
