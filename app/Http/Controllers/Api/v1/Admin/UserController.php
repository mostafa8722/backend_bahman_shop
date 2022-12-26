<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\Collections\UserCollection;
use App\Http\Resources\v1\Admin\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $users = new User();

        if (isset($request->name))
            $users->where("name", "LIKE", "%$request->name%");

        if (isset($$request->family))
            $users->where("family", "LIKE", $request->family);

            $users->where("email", "LIKE", $request->email);
            
            if (isset($request->mobile))
            $users->where("email", "LIKE", $request->mobile);
    

        $users =  $users->orderBy("id", "DESC")->paginate(20);


        return new UserCollection($users);
    }
    public function create(Request $request)
    {

        if (!isset($request->name))
            return response([
                "data" => "name can't be empty",
                "status" => 403
            ], 403);

        if (!isset($request->family))
            return response([
                "data" => "family  can't be empty",
                "status" => 403
            ], 403);

            if (!isset($request->email))
            return response([
                "data" => "email  can't be empty",
                "status" => 403
            ], 403);

            if (!isset($request->mobile))
            return response([
                "data" => "mobile  can't be empty",
                "status" => 403
            ], 403);

            $level = "user";
            if (isset($request->level))
             $level = $request->level;



        $src = "";
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "users", time() . $ext);
        }
       
        $inputs = [
            "name" => $request->name,
            "family" => $request->family,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "image" => $src,
            "level" => $level,
            "api_token"=>Str::random(100)
        ];

        
        $user = User::create($inputs);


        return response([
            "data" => "user created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, User $user)
    {

        if (!isset($request->name))
            return response([
                "data" => "name can't be empty",
                "status" => 403
            ], 403);

        if (!isset($request->family))
            return response([
                "data" => "family  can't be empty",
                "status" => 403
            ], 403);

            if (!isset($request->email))
            return response([
                "data" => "email  can't be empty",
                "status" => 403
            ], 403);

            if (!isset($request->mobile))
            return response([
                "data" => "mobile  can't be empty",
                "status" => 403
            ], 403);

            $level = "user";
            if (isset($request->level))
             $level = $request->level;



        $src = "";
        if (isset($request->image)) {
            $image = $request->image;

            $ext = $image->getClientOriginalExtension();
            $ext = "." . strtolower($ext);
            $src = $this->uploadFile($image, "users", time() . $ext);
        }
       
        $inputs = [
            "name" => $request->name,
            "family" => $request->family,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "image" => $src,
            "level" => $level,
            "api_token"=>Str::random(100)
        ];

        $user->update($inputs);


        return response([
            "data" => "user updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(User $user)
    {
        return new UserResource($user);
    }

    public function delete(User $user)
    {

        $user->delete();
        return response([
            "data" => "user deleted successfully",
            "status" => 200
        ], 200);
    }
}
