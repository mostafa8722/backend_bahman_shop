<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\CategoryCollection;
use App\Http\Resources\v1\admin\resource\CategoryResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends MotherController
{

    public function index(Request $request)
    {

        
        $categories = new Category();

        
        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        if (isset($request->title))
            $categories->where("title", "LIKE", "%$request->title%");

        if (isset($request->en_title))
            $categories->where("en_title", "LIKE", $request->en_title);

        if (isset($request->body))
            $categories->where("body", "LIKE","%$request->body%");

        if (isset($request->parent_id))
            $categories->where("parent_id", "=", $request->parent_id);

        $categories =  $categories->orderBy($order, $desc)->paginate(20);


        return new CategoryCollection($categories);
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
                "data" => "engilsh title can't be empty",
                "status" => 403
            ], 403);



        $src = "";
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "categories", time() . $ext);
        }
        $cat_parent = Category::whereId($request->parent_id)->first();
        $user_auth =User::whereApi_token(trim($request->bearerToken()))->whereLevel("admin")->first();

        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "body" => $request->body,
            "parent_id" => $request->parent_id,
            "user_id" => $user_auth->id,
            "image" => $src,
            "level" => $request->parent_id == 0 ? 1 : ($cat_parent->level + 1),

        ];

        
        $category = Category::create($inputs);


        return response([
            "data" => "category created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Category $category)
    {

        if (!isset($request->title))
            return response([
                "data" => "title can't be empty",
                "status" => 403
            ], 403);

        if (!isset($request->en_title))
            return response([
                "data" => "engilsh title can't be empty",
                "status" => 403
            ], 403);



        $src = $category->image;
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "categories", time() . $ext);
        }
        $cat_parent = Category::whereId($request->parent_id)->first();
        $user_auth =User::whereApi_token(trim($request->bearerToken()))->whereLevel("admin")->first();

        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "body" => $request->body,
            "parent_id" => $request->parent_id,
            "user_id" => $user_auth->id,
            "image" => $src,
            "level" => $request->parent_id == 0 ? 1 : ($cat_parent->level + 1),

        ];

        $category->update($inputs);


        return response([
            "data" => "category updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Category $category)
    {

        return new CategoryResource($category);
    }
    public function delete(Category $category)
    {



        $category->delete();
        return response([
            "data" => "category deleted successfully",
            "status" => 200
        ], 200);
    }
}
