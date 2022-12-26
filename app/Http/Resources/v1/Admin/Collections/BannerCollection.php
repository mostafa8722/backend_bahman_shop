<?php

namespace App\Http\Resources\v1\Admin\collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "data"=>$this->collection->map(function($item){
                return [
                    "id"=>$item->id,
                    "title"=>$item->title,
                    "type"=>$item->type,
                    "image"=>$item->image,
                    "body"=>$item->body,
                ];
            })
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
