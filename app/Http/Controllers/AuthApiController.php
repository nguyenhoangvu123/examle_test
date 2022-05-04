<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\BaseApiController;

class AuthApiController extends BaseApiController
{
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request) {
        try {
            return $this->sendDataSuccess(
                $this->authService->login($request)
            );
        } catch (\Exception $exception) {
           
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $exception->getStatusCode());
        }
    }
}
