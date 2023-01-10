<?php

namespace App\Http\Resources\v1\Admin\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = Product::where("id","=",$this->product_id)->first();
        
        return [
            "user_id"=>$this->user_id,
            "product_id"=>$this->product_id,
            "product"=>$product?$product->title:"",
            "body"=>$this->body,
            "rate1"=>$this->rate1,
            "rate2"=>$this->rate2,
            "rate3"=>$this->rate3,
            "rate4"=>$this->rate4,
            "total_rate"=>$this->total_rate,
            "status"=>$this->status,
        ];
    }
}
