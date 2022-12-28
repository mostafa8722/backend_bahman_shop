<?php

namespace App\Http\Controllers\Api\v1\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\BannerCollection;
use App\Http\Resources\v1\Home\Collection\ProductCollection;
use App\Http\Resources\v1\Home\Collections\CategoryCollection;
use App\Http\Resources\v1\Home\Collections\PostCollection;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    
    public function Index(){

        $categories = Category::where("parent_id","=",0)->oldest()->get();

        $sliders = Banner::where("type","=","slider")->lastest()->get();

        $new_products = Product::where("status","=","release")->latest()->take(12)->get();
        $most_sell_products = DB::table('products')
        ->select("*")
        ->join("orders","orders.product_id","=","products.id")->take(12)->get();
        
  
        $most_viewed_products = Product::
        where("status","=","release")
        ->where("viewed",">",10)
        ->orderBy("viewed","DESC")->take(12)->get();

            
        $new_posts= Post::latest()->take(3)->get();

        return response([
           "data"=>[
            "categories"=>new CategoryCollection($categories),
            "slider"=>new BannerCollection($sliders),
            "newest"=> new ProductCollection($new_products),
            "most_sell_product"=> new ProductCollection($most_sell_products),
            "most_viewed_products"=> new ProductCollection($most_viewed_products),
            "new_posts"=>new PostCollection($new_posts)
           ]
        ],200);
    }


public function products(Request $request){

}
}
