<?php

namespace App\Http\Resources\v1\Admin\collections;

use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
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
                $product = Product::where("id","=",$item->product_id)->first();
                return [
                    "user_id"=>$item->user_id,
                    "product_id"=>$item->product_id,
                    "product"=>$product?$product->title:"",
                    "body"=>$item->body,
                    "rate1"=>$item->rate1,
                    "rate2"=>$item->rate2,
                    "rate3"=>$item->rate3,
                    "rate4"=>$item->rate4,
                    "total_rate"=>$item->total_rate,
                    "status"=>$item->status,
                ];
            })
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
