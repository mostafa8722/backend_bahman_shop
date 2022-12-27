<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\Collections\PageCollection;
use App\Http\Resources\v1\Admin\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
   
    public function index(Request $request)
    {

        
        $pages = new Page();

        
        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        if (isset($request->title))
            $pages->where("title", "LIKE", "%$request->title%");

        if (isset($request->en_title))
            $pages->where("en_title", "LIKE", $request->en_title);

        if (isset($request->body))
            $pages->where("body", "LIKE","%$request->body%");

        if (isset($request->parent_id))
            $pages->where("parent_id", "=", $request->parent_id);

        $pages =  $pages->orderBy($order, $desc)->paginate(20);


        return new PageCollection($pages);
    }
    public function create(Request $request)
    {

        if (!isset($request->title))
            return response([
                "data" => "title can't be empty",
                "status" => 403
            ], 403);

        if (!isset($request->body))
            return response([
                "data" => " description can't be empty",
                "status" => 403
            ], 403);



        $src = "";
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "pages", time() . $ext);
        }
       
        $inputs = [
            "title" => $request->title,
            "type" => $request->type,
            "body" => $request->body,
            "image" => $src,
        

        ];

        
        $page = Page::create($inputs);


        return response([
            "data" => "page created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Page $page)
    {

        
        if (!isset($request->title))
            return response([
                "data" => "title can't be empty",
                "status" => 403
            ], 403);

        if (!isset($request->body))
            return response([
                "data" => " description can't be empty",
                "status" => 403
            ], 403);



        $src = $page->image;
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "pages", time() . $ext);
        }
       
        $inputs = [
            "title" => $request->title,
            "type" => $request->type,
            "body" => $request->body,
            "image" => $src,
        ];

        $page->update($inputs);


        return response([
            "data" => "page updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Page $page)
    {

        return new PageResource($page);
    }
    public function delete(Page $page)
    {



        $page->delete();
        return response([
            "data" => "page deleted successfully",
            "status" => 200
        ], 200);
    }
}
