<?php

namespace App\Http\Resources\v1\Admin\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
            "data" =>$this->collection->map(function($item){

                return [
                    "id"=>$item->id,
                    "name"=>$item->name,
                    "family"=>$item->family,
                    "mobile"=>$item->mobile,
                    "email"=>$item->email,
                    "level"=>$item->level,
                    "api_token"=>$item->api_token,
                ];
            })
        ];
       
      
    }
    public  function with($request)
    {
         return ["status"=>200];
    }
}
