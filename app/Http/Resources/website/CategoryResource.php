<?php

namespace App\Http\Resources\website;

use App\Http\Resources\business\ProductResource;
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
            'id' => $this->id,
            'logo' => $this->logo,
            'business' => $this->business,
            'category_infos' => $this->category_infos,
            'products'=>ProductResource::collection($this->products)
        ];
    }
}
