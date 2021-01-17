<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = new ProducteurResource($this->producers);
        return [
            'id' => $this->id,
            'prix' => $this->prix,
            'name' => $this->name,
            'id_producer' => $user,
            'quantite' => $this->quantite,
        ];
    }
}
