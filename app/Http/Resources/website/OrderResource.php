<?php

namespace App\Http\Resources\website;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'amount' => $this->amount,
            'order_num' => $this->order_num,
            'order_status' => $this->order_status,
            'table_token' => $this->table_token,
            'cart' => $this->cart,
            'products' => $this->cart->products,
        ];
    }
}
