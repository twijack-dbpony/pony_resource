<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GamePonyResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'thumb' => '/thumb/'.$this->thumb,
            'sex' => config('pony.sex')[$this->sex],
            'race' => config('pony.race')[$this->race],
            'desc' => $this->desc,
        ];
    }
}
