<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthRepositoryInterface;

class AuthService extends BaseService
{
    protected $authRepo;
    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }
    public function login($request)
    {   
        $datas = [
            'email'    => $request->email,
            'password' => $request->password
        ];
        if (!Auth::attempt($datas))
        abort(422, 'Email, tài khoản hoặc mật khẩu không đúng !');
        $user = $this->authRepo->getUser($datas);
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return [
            'token'     => 'Bearer ' . $tokenResult
        ];
    }
}
