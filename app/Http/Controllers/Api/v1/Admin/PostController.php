<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\Collections\PostCollection;
use App\Http\Resources\v1\Admin\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {

        
        $posts = new Post();

        
        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        if (isset($request->title))
            $posts->where("title", "LIKE", "%$request->title%");

        if (isset($request->en_title))
            $posts->where("en_title", "LIKE", $request->en_title);

        if (isset($request->body))
            $posts->where("body", "LIKE","%$request->body%");

        if (isset($request->parent_id))
            $posts->where("parent_id", "=", $request->parent_id);

        $posts =  $posts->orderBy($order, $desc)->paginate(20);


        return new PostCollection($posts);
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
            $src = $this->uploadFile($image, "posts", time() . $ext);
        }
       
        $user_auth =User::whereApi_token(trim($request->bearerToken()))->whereLevel("admin")->first();

        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "body" => $request->body,
            "category" => $request->category,
            "user_id" => $user_auth->id,
            "image" => $src,
           
        ];

        
        $post = Post::create($inputs);


        return response([
            "data" => "post created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Post $post)
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



        $src = $post->image;
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "posts", time() . $ext);
        }
       
        $user_auth =User::whereApi_token(trim($request->bearerToken()))->whereLevel("admin")->first();

        $inputs = [
            "title" => $request->title,
            "en_title" => $request->en_title,
            "body" => $request->body,
            "category" => $request->category,
            "user_id" => $user_auth->id,
            "image" => $src,
        ];

        $post->update($inputs);


        return response([
            "data" => "post updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Post $post)
    {

        return new PostResource($post);
    }
    public function delete(Post $post)
    {



        $post->delete();
        return response([
            "data" => "post deleted successfully",
            "status" => 200
        ], 200);
    }
}
