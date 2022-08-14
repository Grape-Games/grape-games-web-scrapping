<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\PriceResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResourcesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'prices' => PriceResource::collection($this->collection),
            'total_records' => count($this->collection)
        ];
    }
}
