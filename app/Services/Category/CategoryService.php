<?php

namespace App\Services\Category;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Services\BaseService;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryService extends BaseService
{
    protected $categoryRepo;
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    
    public function index($request) {
        $categories = $this->categoryRepo->getAllCategory($request);
        return new CategoryCollection($categories);
    }

    public function store($request)
    {
        if ($request->parent_id) {
            $this->categoryRepo->checkParentCategory($request->parent_id);
        }

        $datas = $request->all();
        $category = $this->categoryRepo->store($datas);
        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->categoryRepo->find($id);
        return new CategoryResource($category);
    }

    public function update($request, $id)
    {
        $datas = $request->all();
        if ($request->parent_id) {
            $this->categoryRepo->checkParentCategory($request->parent_id ,$id);
            $this->categoryRepo->checkUpdateChilCategoryFollowParent($id, $request->parent_id);
        }
        return $this->categoryRepo->update($id, $datas);
    }

    public function delete($id) {
       
        return $this->categoryRepo->deleteCategory($id);
    }

    
    
}
