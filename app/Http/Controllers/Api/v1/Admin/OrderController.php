<?php

namespace App\Http\Controllers\Api\v1\Admin;


use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\Collections\OrderCollection;
use App\Http\Resources\v1\Admin\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $orders =  Order::orderBy($order, $desc)->paginate(20);

        return new OrderCollection($orders);
    }
  
    public function update(Request $request, Order $order)
    {
        if (!isset($request->title))
        return response([
            "data" => "title can't be empty",
            "status" => 403
        ], 403);

    if (!isset($request->en_title))
        return response([
            "data" => "english title can't be empty",
            "status" => 403
        ], 403);

        if (!isset($request->value))
        return response([
            "data" => "value  can't be empty",
            "status" => 403
        ], 403);

    $inputs = [
        "title" => $request->title,
        "en_title" => $request->en_title,
        "value" => $request->value,
    ];
    

        $order->update($inputs);


        return response([
            "data" => "order updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Order $order)
    {

        return new OrderResource($order);
    }
    public function delete(Order $order)
    {



        $order->delete();
        return response([
            "data" => "order deleted successfully",
            "status" => 200
        ], 200);
    }
}


