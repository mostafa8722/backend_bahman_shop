<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\PermissionCollection;
use App\Http\Resources\v1\admin\resource\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $permissions =  Permission::orderBy($order, $desc)->paginate(20);

        return new PermissionCollection($permissions);
    }
    public function create(Request $request)
    {

        if (!isset($request->title))
            return response([
                "data" => "title can't be empty",
                "status" => 403
            ], 403);

        if (!isset($request->label))
            return response([
                "data" => "label can't be empty",
                "status" => 403
            ], 403);
        $inputs = [
            "title" => $request->title,
            "description" => $request->description,
            "label" => $request->label,
        ];

        $permission = Permission::create($inputs);


        return response([
            "data" => "Permission created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Permission $permission)
    {

            if (!isset($request->title))
            return response([
                "data" => "title can't be empty",
                "status" => 403
            ], 403);

        if (!isset($request->label))
            return response([
                "data" => "label can't be empty",
                "status" => 403
            ], 403);

        $inputs = [
            "title" => $request->title,
            "description" => $request->description,
            "label" => $request->label,
        ];



    

        $permission->update($inputs);


        return response([
            "data" => "permission updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Permission $permission)
    {

        return new PermissionResource($permission);
    }
    public function delete(Permission $permission)
    {



        $permission->delete();
        return response([
            "data" => "permission deleted successfully",
            "status" => 200
        ], 200);
    }
}
