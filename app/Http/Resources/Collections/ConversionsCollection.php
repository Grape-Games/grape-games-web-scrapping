<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\ConversionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConversionsCollection extends ResourceCollection
{
    public static $wrap = 'conversions';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'countries' => ConversionResource::collection($this->collection),
            'total_records' => count($this->collection)
        ];
    }
}
