<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = new UsersResource($this->user);
        $products = ProductResource::collection($this->products);
        $livraison = new LivraisonResource($this->adresseLivraison);
        $facturation = new FacturationResource($this->adresseFacturation);
        return [
            'id' => $this->id,
            'user' => $user,
            'products' => $products,
            'date' => $this->created_at,
            'adresse_livraison' => $livraison,
            'adresse_facturation' => $facturation,
            'quantite' => $this->quantite
        ];
    }
}
