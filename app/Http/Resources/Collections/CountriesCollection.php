<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountriesCollection extends ResourceCollection
{
    public static $wrap = 'countries';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'collection' => CountryResource::collection($this->collection),
            'total_records' => count($this->collection)
        ];
    }
}
