<?php

namespace App\Http\Resources\v1\Admin\collections;

use App\Models\Category;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
                $cat = Category::where("id","=",$item->parent_id)->first();
                return [
                    "id"=>$item->id,
                    "title"=>$item->title,
                    "en_title"=>$item->en_title,
                    "body"=>$item->body,
                    "image"=>$item->image,
                    "parent_id"=>$item->parent_id,
                    "parent"=>$cat?$cat->title:"",
                    "level"=>$item->level,
                ];
            })
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
