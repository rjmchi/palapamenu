<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'sort_order'=> $this->sort_order,
            'price' => $this->price,
            'instructions' => $this->instructions,
            'category_id'=> $this->category_id,
            'no_of_choices' => $this->no_of_choices,           
        ];
    }
}
