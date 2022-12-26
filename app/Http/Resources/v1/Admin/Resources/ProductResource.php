<?php

namespace App\Http\Resources\v1\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            "user_id"=>$this->id,
            "seller_id"=>$this->seller_id,
            "category_id"=>$this->category_id,
            "brand_id"=>$this->brand_id,
            "title"=>$this->title,
            "en_title"=>$this->en_title,
            "abstract"=>$this->abstract,
            "discription"=>$this->discription,
            "price"=>$this->price,
            "discription"=>$this->discription,
            "limited_number"=>$this->limited_number,
            "isAvailable"=>$this->isAvailable,
            "details"=>$this->details,
            "features"=>$this->features,
            "discription"=>$this->discription,
            "colors"=>$this->colors,
            "sizes"=>$this->sizes,
            "status"=>$this->status,
        ];
    }
    
    public function with($request){
        return ["status"=>200];
    }
}
