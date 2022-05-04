<?php

namespace App\Repositories\Layout;

use App\Models\Layout;
use App\Repositories\BaseRepository;
use App\Repositories\Layout\LayoutRepositoryInterface;

class LayoutRepository extends BaseRepository implements LayoutRepositoryInterface
{
    public function getModel()
    {
        return Layout::class;
    }

    public function getFilePath()
    {
        return $this->model::FILE_PATH_LAYOUT;
    }

    public function getTypeUserLayout()
    {
        return $this->model::TYPE_USER_LAYOUT;
    }

    public function getTypeView()
    {
        return $this->model::TYPE_USER_LAYOUT['view'];
    }


    public function getTypeLike()
    {
        return $this->model::TYPE_USER_LAYOUT['like'];
    }

    public function storeCategoryLayout(object $layout, array $categories)
    {
        $layout->categories()->attach($categories);
    }

    public function findLayout($id)
    {
        $result = $this->model->with(['categories' => function ($q) {
            $q->select('categories.id', 'categories.name');
        }])->select('id', 'name', 'avatar', 'url', 'preview', 'orientation', 'created_at')
            ->findOrFail($id);
        return $result;
    }

    public function updateCategoryLayout(object $layout, array $categories)
    {
        $layout->categories()->sync($categories);
    }

    public function deleteCategoryLayout(object $layout)
    {
        $layout->categories()->detach();
    }

    public function getAllLayout($limit = null)
    {
        $result = $this->model->with(['categories' => function ($q) {
            $q->select('categories.id', 'categories.name');
        }])
            ->orderBy('id', 'DESC')
            ->select('id', 'name', 'avatar', 'url', 'preview', 'orientation', 'created_at')
            ->paginate($limit);
        return $result;
    }
}
