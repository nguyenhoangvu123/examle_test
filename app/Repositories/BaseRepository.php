<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function sortByCondition($colum, $type ,array $condition)
    {
        return $this->model->where($condition)->orderBy($colum ,$type)->get();
    }

    public function find($id)
    {
        $result = $this->model->findOrFail($id);

        return $result;
    }

    public function store(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $result = $this->model->findOrFail($id);
        $result->update($attributes);
        return true;
    }

    public function delete(int $id)
    {
        $result = $this->model->findOrFail($id);
        $result->delete();
        return true;
    }
}
