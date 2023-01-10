<?php

namespace App\Http\Resources\v1\Admin\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
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
                    "body"=>$item->body,
                    "price"=>$item->price,
                    "user_id"=>$item->user_id,
                    "status"=>$item->status,
                ];
            })
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
