<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\SizeCollection;
use App\Http\Resources\v1\Admin\Resources\SizeResource;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $sizes =  Size::orderBy($order, $desc)->paginate(20);

        return new SizeCollection($sizes);
    }
    public function create(Request $request)
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
                "data" => "size can't be empty",
                "status" => 403
            ], 403);

        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "value" => $request->value
        ];

        $size = Size::create($inputs);


        return response([
            "data" => "size created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Size $size)
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
                "data" => "size can't be empty",
                "status" => 403
            ], 403);

        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "value" => $request->value
        ];



    

        $size->update($inputs);


        return response([
            "data" => "size updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Size $size)
    {

        return new SizeResource($size);
    }
    public function delete(Size $size)
    {



        $size->delete();
        return response([
            "data" => "size deleted successfully",
            "status" => 200
        ], 200);
    }
}
