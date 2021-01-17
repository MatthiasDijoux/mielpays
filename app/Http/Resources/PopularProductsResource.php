<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PopularProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = new ProductResource($this->product);
        return [
            'id' => $this->id,
            'id_product' => $product,
            'quantite_acheté' => $this->quantite_acheté,
        ];
    }
}
