<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LayoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $categories = $this->whenLoaded('categories');
        return [
            "id"                => $this->id,
            "name"              => $this->name,
            "avatar"            => $this->avatar,
            "url"               => $this->url,
            "preview"           => $this->orientation,
            "categories"        => $categories ?? ""
        ];
    }
}
