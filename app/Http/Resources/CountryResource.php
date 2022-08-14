<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'code3' => $this->code3,
            'currency' => $this->currency,
            'phone_prefix' => $this->phone_prefix,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s A'),
        ];
    }
}
