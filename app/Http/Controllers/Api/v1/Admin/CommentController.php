<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\CommentCollection;
use App\Http\Resources\v1\Admin\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {

        $comment = "id";
        $desc = "DESC";

        if (isset($request->comment))
            $order  = $request->comment;

        if (isset($request->desc))
            $order  = $request->desc;

        $comments =  Comment::commentBy($order, $desc)->paginate(20);

        return new CommentCollection($comments);
    }
  
    public function update(Request $request, Comment $comment)
    {
        if (!isset($request->status))
        return response([
            "data" => "status can't be empty",
            "status" => 403
        ], 403);

  

      

    $inputs = [
        "status" => $request->status,
      
    ];
    

        $comment->update($inputs);


        return response([
            "data" => "comment updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Comment $comment)
    {

        return new CommentResource($comment);
    }
    public function delete(Comment $comment)
    {



        $comment->delete();
        return response([
            "data" => "comment deleted successfully",
            "status" => 200
        ], 200);
    }
}
