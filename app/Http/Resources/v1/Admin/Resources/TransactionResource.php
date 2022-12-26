<?php

namespace App\Http\Resources\v1\Admin\Resources;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::where('id',"=",$this->user_id)->first();
        $order = Order::where('id',"=",$this->order_id)->first();
        return [
            "id"=>$this->id,
            "user_id"=>$this->user_id,
            "user"=>$user?($user->name." ".$user->family):"",
            "order_id"=>$this->order_id,
            "order"=>$order->body,
            "price"=>$this->price,
            "is_paid"=>$this->is_paid,
        ];
    }
    public  function with($request)
    {
        return ["status"=>200];
    }
}
