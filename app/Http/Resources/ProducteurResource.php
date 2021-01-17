<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProducteurResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'id_user' => $user,
            'adresse' => $this->adresse,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
