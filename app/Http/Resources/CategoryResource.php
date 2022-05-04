<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\RelationCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'parent'            => $this->parentCategory
                ? new RelationCategoryResource($this->parentCategory)
                : "",
            'child'            => $this->childCategory
                ? RelationCategoryResource::collection($this->childCategory) : ""
                ,

            'created_at'        => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
