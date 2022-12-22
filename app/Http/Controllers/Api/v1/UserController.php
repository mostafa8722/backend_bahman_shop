<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function login(Request $request){

        return response([
            "data" =>"error",
            "status" =>false
        ],404);
        $inputs  = $request->all();
        $user =  User::where("mobile","=",$request->mobile)->first();
        

    }
}
