<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";


        $userAddresses =  new UserAddress();

        if(isset($request->user_id))
        $userAddresses = $userAddresses->where("user_id","=",$request->user_id);

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $userAddresses =  $userAddresses->orderBy($order, $desc)->paginate(20);

        return response([
            "data" => $userAddresses,
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

        
        if(!isset($request->title))
        return response([
            "data" => "title must be declared",
            "status" => 403
        ], 403);

        if(!isset($request->address))
        return response([
            "data" => "address must be declared",
            "status" => 403
        ], 403);

        $inputs = [
            "user_id" => $request->user_id,
            "title" => $request->title,
            "lat" => $request->lat,
            "lng" => $request->lng,
            "address" => $request->address,
           
        ];
        $userAddress = UserAddress::create($inputs);
        return response([
            "data" => "user address created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, UserAddress $userAddress)
    {

        if(!isset($request->user_id))
        return response([
            "data" => "user must be declared",
            "status" => 403
        ], 403);

        
        if(!isset($request->title))
        return response([
            "data" => "title must be declared",
            "status" => 403
        ], 403);

        if(!isset($request->address))
        return response([
            "data" => "address must be declared",
            "status" => 403
        ], 403);

        $inputs = [
            "user_id" => $request->user_id,
            "title" => $request->title,
            "lat" => $request->lat,
            "lng" => $request->lng,
            "address" => $request->address,
        ];

        $userAddress->update($inputs);
        return response([
            "data" => "user address updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(UserAddress $userAddress)
    {
        return response([
            "data" =>$userAddress,
            "status" => 200
        ], 200);
      
    }
    public function delete(UserAddress $userAddress)
    {
        $userAddress->delete();
        return response([
            "data" => "user address deleted successfully",
            "status" => 200
        ], 200);
    }
}
