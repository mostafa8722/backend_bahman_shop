<?php

namespace App\Http\Resources\v1\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
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
            "id"=>$this->id,
            "title"=>$this->title,
            "en_title"=>$this->en_title,
            "value"=>$this->value,
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
