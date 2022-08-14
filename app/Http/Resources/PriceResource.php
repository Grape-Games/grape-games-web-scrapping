<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'price' => $this->price,
            'country' => $this->country->name,
            'dated' => $this->dated,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s A'),
        ];
        parent::toArray($request);
    }
}
