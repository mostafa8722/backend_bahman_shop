<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\ColorCollection;
use App\Http\Resources\v1\Admin\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $colors =  Color::orderBy($order, $desc)->paginate(20);

        return new ColorCollection($colors);
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
                "data" => "value  can't be empty",
                "status" => 403
            ], 403);

        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "value" => $request->value,
        ];

        $color = Color::create($inputs);


        return response([
            "data" => "Color created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Color $color)
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
    

        $color->update($inputs);


        return response([
            "data" => "color updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Color $color)
    {

        return new ColorResource($color);
    }
    public function delete(Color $color)
    {



        $color->delete();
        return response([
            "data" => "color deleted successfully",
            "status" => 200
        ], 200);
    }
}
