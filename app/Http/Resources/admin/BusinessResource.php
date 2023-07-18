<?php

namespace App\Http\Resources\admin;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            'address' => $this->address,
            'share_location' => $this->share_location,
            'mobile_number' => $this->mobile_number,
            'phone_number' => $this->phone_number,
            'business_logo' => $this->business_logo,
            'logo_note' => $this->logo_note,
            'business_banner' => $this->business_banner,
            'request_photoshot' => $this->request_photoshot,
            'do_you_have_delivery' => $this->do_you_have_delivery,
            'request_redesign_logo' => $this->request_redesign_logo,
            'delivery_company_name' => $this->delivery_company_name,
            'other_info' => $this->other_info,
            'other_business_type' => $this->other_business_type,
            'country' => $this->country,
            'city' => $this->package,
            'business_type' => $this->business_type,
            'main_language' => $this->main_language,
            'second_language' => $this->second_language,
            'social_links' => $this->social_links,
            'user' => $this->user,

        ];
    }
}
