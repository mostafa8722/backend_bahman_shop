<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";


        $userInfos =  new UserInfo();

        if(isset($request->user_id))
        $userInfos = $userInfos->where("user_id","=",$request->user_id);

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $userInfos =  $userInfos->orderBy($order, $desc)->paginate(20);

        return response([
            "data" => $userInfos,
            "status" => 200
        ], 200);

        
    }
    public function create(Request $request)
    {

        if(!isset($request->user_id))
        return response([
            "data" => "user must be declared",
            "status" => 403
        ], 403);

        
        if(!isset($request->name))
        return response([
            "data" => "name must be declared",
            "status" => 403
        ], 403);

        if(!isset($request->family))
        return response([
            "data" => "family must be declared",
            "status" => 403
        ], 403);

        if(!isset($request->national_code))
        return response([
            "data" => "national code must be declared",
            "status" => 403
        ], 403);
    
        if(!isset($request->phone))
        return response([
            "data" => "phone  must be declared",
            "status" => 403
        ], 403);

    
        $inputs = [
            "user_id" => $request->user_id,
            "name" => $request->name,
            "national_code" => $request->national_code,
            "family" => $request->family,
            "phone" => $request->phone,
            "type" =>isset( $request->type)? $request->type:"personal",
           
        ];
        $userAddress = UserInfo::create($inputs);
        return response([
            "data" => "user address created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, UserInfo $userAddress)
    {

        if(!isset($request->user_id))
        return response([
            "data" => "user must be declared",
            "status" => 403
        ], 403);

        
        if(!isset($request->name))
        return response([
            "data" => "name must be declared",
            "status" => 403
        ], 403);

        if(!isset($request->family))
        return response([
            "data" => "family must be declared",
            "status" => 403
        ], 403);

        if(!isset($request->national_code))
        return response([
            "data" => "national code must be declared",
            "status" => 403
        ], 403);
    
        if(!isset($request->phone))
        return response([
            "data" => "phone  must be declared",
            "status" => 403
        ], 403);

    
        $inputs = [
            "user_id" => $request->user_id,
            "name" => $request->name,
            "national_code" => $request->national_code,
            "family" => $request->family,
            "phone" => $request->phone,
            "type" =>isset( $request->type)? $request->type:"personal",
           
        ];
       

        $userAddress->update($inputs);
        return response([
            "data" => "user address updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(UserInfo $userAddress)
    {
        return response([
            "data" =>$userAddress,
            "status" => 200
        ], 200);
      
    }
    public function delete(UserInfo $userAddress)
    {
        $userAddress->delete();
        return response([
            "data" => "user address deleted successfully",
            "status" => 200
        ], 200);
    }

}
