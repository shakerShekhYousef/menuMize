<?php

namespace App\Http\Resources\business;

use App\Models\Business;
use App\Models\SpotlightDailyType;
use Illuminate\Http\Resources\Json\JsonResource;

class SpotlightDailyResource extends JsonResource
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
            'business' => Business::findOrFail($this->business_id),
            'spotlight_daily_type' => SpotlightDailyType::findOrFail($this->spotlight_daily_type_id),
            'products' => $this->products,
        ];
    }
}
