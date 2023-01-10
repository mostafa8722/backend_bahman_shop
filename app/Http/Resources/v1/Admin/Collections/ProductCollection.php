<?php

namespace App\Http\Resources\v1\Admin\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
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
                    "user_id"=>$item->id,
                    "seller_id"=>$item->seller_id,
                    "category_id"=>$item->category_id,
                    "brand_id"=>$item->brand_id,
                    "title"=>$item->title,
                    "title"=>$item->en_title,
                    "abstract"=>$item->abstract,
                    "discription"=>$item->discription,
                    "price"=>$item->price,
                    "discription"=>$item->discription,
                    "limited_number"=>$item->limited_number,
                    "isAvailable"=>$item->isAvailable,
                    "details"=>$item->details,
                    "features"=>$item->features,
                    "discription"=>$item->discription,
                    "colors"=>$item->colors,
                    "sizes"=>$item->sizes,
                    "status"=>$item->status,
                ];
            })
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
