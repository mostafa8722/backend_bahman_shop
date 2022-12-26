<?php

namespace App\Http\Resources\v1\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "family" => $this->family,
            "email" => $this->email,
            "mobile" => $this->mobile,
            "level" => $this->level,
            "api_token" => $this->api_token,
        ];
    }
    public function with($request)
    {
        return ["status" => 200];
    }
}
