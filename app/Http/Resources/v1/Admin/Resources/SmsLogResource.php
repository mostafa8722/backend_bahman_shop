<?php

namespace App\Http\Resources\v1\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SmsLogResource extends JsonResource
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
            "user_id"=>$this->user_id,
            "mobile"=>$this->mobile,
            "code"=>$this->code,
            "is_used"=>$this->is_used,
            "type"=>$this->type,
        ];
    }
    public function with($request){

        return ["status"=>200];
    }
}
