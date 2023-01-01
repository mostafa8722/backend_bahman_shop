<?php

namespace App\Http\Controllers\Api\v1\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    
    public function search(Request $request){

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
}

