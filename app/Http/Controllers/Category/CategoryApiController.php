<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\Category\StoreCatoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryApiController extends BaseApiController
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            return $this->sendDataSuccess(
                $this->categoryService->index()
            );
        } catch (\Exception $exception) {

            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $exception->getStatusCode());
        }
    }

    public function store(StoreCatoryRequest $request)
    {
        try {
            return $this->sendDataSuccess(
                $this->categoryService->store($request)
            );
        } catch (\Exception $exception) {

            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $exception->getStatusCode());
        }
    }

    public function show($id)
    {
        try {
            return $this->sendDataSuccess(
                $this->categoryService->show($id)
            );
        } catch (\Exception $exception) {

            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $exception->getStatusCode());
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            return $this->sendDataSuccess(
                $this->categoryService->update($request, $id)
            );
        } catch (\Exception $exception) {

            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $exception->getStatusCode());
        }
    }

    public function delete($id) {
        try {
            return $this->sendDataSuccess(
                $this->categoryService->delete($id)
            );
        } catch (\Exception $exception) {

            return $this->setMessage($exception
                ->getMessage())
                ->sendDataError('', $exception->getStatusCode());
        }
    }
}
