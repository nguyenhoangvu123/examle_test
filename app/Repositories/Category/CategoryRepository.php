<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function checkParentCategory($parentCategory, $currentCategory = null)
    {
        $cateParent     = $this->model->find($parentCategory);
        
        if ($cateParent->parentCategory && $currentCategory !== $parentCategory)
            abort(422, "Chọn danh mục cha không hợp lệ !");
    }

    public function checkUpdateChilCategoryFollowParent($idCategory, $idParent) {
        $category     = $this->model->find($idCategory);
        $this->checkParentCategory($category, $idParent);
    }

    public function deleteCategory($id) {
        $category   = $this->model->find($id);
        if(!$category) abort(422, "Danh mục không tồn tại");
        $this->checkAndUpdateChildCategory($category , null);
        return $category->delete();
    }

    public function checkAndUpdateChildCategory(object $category , $type = null) {
        if ($category->childCategory) {
            $category->childCategory()->update([
                "parent_id" => $type
            ]);
        }
    }
}
