<?php

namespace App\Services\Layout;

use App\Helpers\Facades\File;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LayoutResource;
use App\Http\Resources\LayoutCollection;
use App\Repositories\Layout\LayoutRepositoryInterface;

class LayoutService extends BaseService
{
    protected $layoutRepo;
    public function __construct(LayoutRepositoryInterface $layoutRepo)
    {
        $this->layoutRepo = $layoutRepo;
    }

    public function index($request) {
        $limit = $request->limit;
        $layouts = $this->layoutRepo->getAllLayout($limit);
        return new LayoutCollection($layouts);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $name           = $request->name;
            $avatar         = $request->avatar;
            $categories     = $request->categories;
            $preview        = $request->preview;
            $orientation    = $request->orientation;
            $url            = $request->url;
            $filePath       = $this->layoutRepo->getFilePath();
            $linkFile       = File::upload($avatar, $filePath);
            $datas          = [
                "avatar"        => $linkFile['avatar'],
                "preview"       => $preview,
                "orientation"   => $orientation,
                "url"           => $url,
                "name"          => $name
            ];
            $layout = $this->layoutRepo->store($datas);
            $this->layoutRepo->storeCategoryLayout($layout, $categories);
            return true;
        });
    }

    public function show($id)
    {
        $layout = $this->layoutRepo->findLayout($id);
        return new LayoutResource($layout);
    }

    public function update($id, $request)
    {

        return DB::transaction(function () use ($request, $id) {

            $name           = $request->name;
            $avatar         = $request->avatar;
            $categories     = $request->categories;
            $preview        = $request->preview;
            $orientation    = $request->orientation;
            $url            = $request->url;
            $filePath       = $this->layoutRepo->getFilePath();
            $layout         = $this->layoutRepo->find($id);
            $linkFileOdl       = $layout->avatar;
            $linkFileNew    = "";
            if ($request->hasFile('avatar')) {
                File::delete($linkFileOdl);
                $linkFileNew       = File::upload($avatar, $filePath);
            }
            $datas          = [
                "avatar"        => $linkFileNew ? $linkFileNew['avatar'] : $linkFileOdl,
                "preview"       => $preview,
                "orientation"   => $orientation,
                "url"           => $url,
                "name"          => $name
            ];
            $this->layoutRepo->update($id,$datas);
            $this->layoutRepo->updateCategoryLayout($layout, $categories);
            return true;
        });
    }

    public function delete($id) {
        $layout = $this->layoutRepo->find($id);
        $this->layoutRepo->deleteCategoryLayout($layout);
        $layout->delete();
        return true;
    }
}
