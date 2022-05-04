<?php

namespace App\Repositories\User;

use App\Models\UserLayout;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserLayoutRepositoryInterface;

class UserLayoutRepository extends BaseRepository implements UserLayoutRepositoryInterface
{
    public function getModel()
    {
        return UserLayout::class;
    }


    public function insertViewAndLikeLayout(object $user, $layoutId, $type)
    {
        return  $this->model->updateOrCreate(
            ["layout_id" => $layoutId, "user_id" => $user->id ,'type' => $type],
            ["layout_id" => $layoutId, "user_id" => $user->id, 'type' => $type]
        );
    }
}
