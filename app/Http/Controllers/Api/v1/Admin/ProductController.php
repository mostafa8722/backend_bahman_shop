<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\Collections\ProductCollection;
use App\Http\Resources\v1\Admin\Resources\ProductResource;
use App\Models\Product ;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends MotherController
{
    
    public function index(Request $request)
    {
        $products = new Product(); 

        if (isset($request->title))
            $products->where("title", "LIKE", "%$request->title%");

        if (isset($request->en_title))
            $products->where("en_title", "LIKE", $request->en_title);

        if (isset($request->body))
            $products->where("body", "LIKE", $request->body);

        if (isset($request->category_id))
            $products->where("category_id", "=", $request->category_id);



        $products =  $products->orderBy("id", "DESC")->paginate(20);


        return new ProductCollection($products);
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

            if (!isset($request->discription))
            return response([
                "data" => "description  can't be empty",
                "status" => 403
            ], 403);




        $src = "";

        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "products", time() . $ext);
        }
      
        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "discription" => $request->discription,
            "abstract" => $request->abstract,
            
            "images" => ['thumbnail'=>$src],
           // "images" => ['thumbnail'=>$src,"attachment"=>"attachment"],
            "status" => isset($request->status)?$request->status:"draft",

        ];

     
        
        $product = Product::create($inputs);


        return response([
            "data" => "product created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Product $product)
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



        $src = $product->image;
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "products", time() . $ext);
        }
        $cat_parent = Product::whereId($request->parent_id)->first();
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

        $product->update($inputs);


        return response([
            "data" => "product updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Product $product)
    {

        return new ProductResource($product);
    }
    public function delete(Product $product)
    {



        $product->delete();
        return response([
            "data" => "product deleted successfully",
            "status" => 200
        ], 200);
    }

}
