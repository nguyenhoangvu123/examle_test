<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Services\Layout\LayoutService;
use App\Http\Requests\User\UserViewLayout;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Layout\StoreLayoutRequest;
use App\Http\Requests\Layout\UpdateLayoutRequest;

class LayoutApiController extends BaseApiController
{
    protected $layoutService;
    public function __construct(LayoutService $layoutService)
    {
        $this->layoutService = $layoutService;
    }

    public function index(Request $request)
    {
        try {
            return $this->sendDataSuccess(
                $this->layoutService->index($request)
            );
        } catch (\Exception $exception) {
            $statusCode =  $exception->getCode() === 0 ? 500 : $exception->getStatusCode();
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $statusCode);
        }
    }

    public function store(StoreLayoutRequest $request)
    {
        try {
            return $this->sendDataSuccess(
                $this->layoutService->store($request)
            );
        } catch (\Exception $exception) {
            $statusCode =  $exception->getCode() === 0 ? 500 : $exception->getStatusCode();
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $statusCode);
        }
    }

    public function show($id)
    {
        try {
            return $this->sendDataSuccess(
                $this->layoutService->show($id)
            );
        } catch (\Exception $exception) {
            $statusCode =  $exception->getCode() === 0 ? 500 : $exception->getStatusCode();
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $statusCode);
        }
    }

    public function update(UpdateLayoutRequest $request, $id)
    {
        try {
            return $this->sendDataSuccess(
                $this->layoutService->update($id, $request)
            );
        } catch (\Exception $exception) {
            $statusCode =  $exception->getCode() === 0 ? 500 : $exception->getStatusCode();
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $statusCode);
        }
    }

    public function delete($id)
    {
        try {
            return $this->sendDataSuccess(
                $this->layoutService->delete($id)
            );
        } catch (\Exception $exception) {
            $statusCode =  $exception->getCode() === 0 ? 500 : $exception->getStatusCode();
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $statusCode);
        }
    }

    public function UserViewLayout(UserViewLayout $request) {
       
        try {
            return $this->sendDataSuccess(
                $this->layoutService->userViewAndLikeLayout($request)
            );
        } catch (\Exception $exception) {
            $statusCode =  $exception->getCode() === 0 ? 500 : $exception->getStatusCode();
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $statusCode);
        }
    }

    public function filedUserLayout()
    {   
        dd(123123);
        try {
            return $this->sendDataSuccess(
                $this->layoutService->filedUserLayout()
            );
        } catch (\Exception $exception) {
            $statusCode =  $exception->getCode() === 0 ? 500 : $exception->getStatusCode();
            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $statusCode);
        }
    }
}
