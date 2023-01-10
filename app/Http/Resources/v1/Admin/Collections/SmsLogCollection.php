<?php

namespace App\Http\Resources\v1\Admin\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SmsLogCollection extends ResourceCollection
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
                    "user_id"=>$item->user_id,
                    "mobile"=>$item->mobile,
                    "code"=>$item->code,
                    "is_used"=>$item->is_used,
                    "type"=>$item->type,
                ];
            })
        ];
    }
    public function with($request){
        return ["status"=>200];
    }
}
