<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'es_name' => $this->translate('es')->name,
            'en_name' => $this->translate('en')->name,
            'es_description' => $this->translate('es')->description,
            'en_description' => $this->translate('en')->description,
            'sort_order' => $this->sort_order,
            'menu_id' => $this->menu_id,
            'items' => ItemResource::collection($this->items),
        ];
    }
}
