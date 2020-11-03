<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChoiceResource extends JsonResource
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
            'sort_order'=> $this->sort_order,
            'instructions' => $this->instructions,
            'item_id'=> $this->item_id,
        ];    
    }
}
