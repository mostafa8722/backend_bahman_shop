<?php

namespace App\Http\Resources\v1\Admin\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cat = Category::where("id","=",$this->parent_id)->first();
        return [
            "id"=>$this->id,
            "title"=>$this->title,
            "en_title"=>$this->en_title,
            "body"=>$this->body,
            "image"=>$this->image,
            "parent_id"=>$this->parent_id,
            "parent"=>$cat?$cat->title:"",
            "level"=>$this->level,
        ];
    }
    public function with($request){
        return ["status"=>200];
    }

}
