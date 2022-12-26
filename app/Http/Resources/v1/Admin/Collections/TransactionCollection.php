<?php

namespace App\Http\Resources\v1\Admin\collections;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
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
                $user = User::where('id',"=",$item->user_id)->first();
                $order = Order::where('id',"=",$item->order_id)->first();
                return [
                    "id"=>$item->id,
                    "user_id"=>$item->user_id,
                    "user"=>$user?($user->name." ".$user->family):"",
                    "order_id"=>$item->order_id,
                    "order"=>$order->body,
                    "price"=>$item->price,
                    "is_paid"=>$item->is_paid,
                ];
            })
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
