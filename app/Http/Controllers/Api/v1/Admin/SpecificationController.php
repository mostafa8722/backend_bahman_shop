<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\Specificity;

class SpecificationController extends Controller
{
    
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $specifications =  Specification::orderBy($order, $desc)->paginate(20);

        
        return response([
            "data" => $specifications,
            "status" => 200
        ], 200);
    }
    public function create(Request $request)
    {

        if (!isset($request->index))
            return response([
                "data" => "index can't be empty",
                "status" => 403
            ], 403);

            if (!isset($request->item))
            return response([
                "data" => "item  can't be empty",
                "status" => 403
            ], 403);

        

        $inputs = [
            "index" => $request->index,
            "item" => $request->item,
         
        ];

        $specification = Specification::create($inputs);


        return response([
            "data" => "specification created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Specification $specification)
    {

        if (!isset($request->index))
        return response([
            "data" => "index can't be empty",
            "status" => 403
        ], 403);

        if (!isset($request->item))
        return response([
            "data" => "item  can't be empty",
            "status" => 403
        ], 403);    

    $inputs = [
        "index" => $request->index,
        "item" => $request->item,
    ];


    

        $specification->update($inputs);


        return response([
            "data" => "specification updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Specification $specification)
    {

        return response([
            "data" => $specification,
            "status" => 200
        ], 200);
    }
    public function delete(Specification $specification)
    {



        $specification->delete();
        return response([
            "data" => "specification deleted successfully",
            "status" => 200
        ], 200);
    }
}
