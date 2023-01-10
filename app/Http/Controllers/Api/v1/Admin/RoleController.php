<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\collections\RoleCollection;
use App\Http\Resources\v1\Admin\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function index(Request $reqest){
        $page = $reqest->page?$reqest->page:1;
    
        
        $roles =  Role::orderBy("id","DESC")->paginate(20);

    
        return new RoleCollection($roles);
    }

    public function create(Request $request){
      
    
        
      $role = Role::create($request->all());
      $role->permissions()->sync($request->permissions);

         return response([
            "data"=>"role created successfully",
            "status" =>200
         ],200);

     
 }

 
 public function update(Role $role,Request $request){
      
    
        
    $role ->update($request->all());
    $role->permissions()->sync($request->permissions);
       return response([
          "data"=>"role updated successfully",
          "status" =>200
       ],200);
   
}

public function delete(Role $role){
      
    
        
    $role ->delete();
       return response([
          "data"=>"role deleted successfully",
          "status" =>200
       ],200);
   
}

    public function single(Role $role){
      
    
    
        return new RoleResource($role);
    }
}
