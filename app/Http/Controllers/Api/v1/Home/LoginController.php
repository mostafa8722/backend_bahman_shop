<?php

namespace App\Http\Controllers\Api\v1\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Home\Resources\UserResource;

use App\Models\SmsLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request){
 

        $mobile = $request->mobile;

        if(!isset($mobile ))
        return response([
           "data"=>"وارد کردن شماره موبایل الزامی است ",
           "status" =>422
        ],422);
        
        if(!$mobile  || strlen($mobile)!=11)
         return response([
            "data"=>"فرمت موبایل وارد شده صحیح نمی باشد ",
            "status" =>422
         ],422);
   

         $user = User::whereMobile($mobile)->first();

         if(!$user )
         return response([
            "data"=>"    شما قبلا ثبت نام نکرده اید ",
            "status" =>404
         ],404); 
           

         if( !$user->auth)
         return response([
            "data"=>"   ثبت نام شده قبلا کامل نشده است ",
            "status" =>404
         ],404);
           

         $code = rand(100000,999999) ;
         $inputs = [
            "user_id"=>$user->id,
            "mobile"=>$mobile,
            "code"=>$code,
            "type"=>"auth",
         ];
         $sms = SmsLog::create($inputs);

         return response([
            "data"=>"کد فعالسازی به شماره موبایل شما ارسال شد",
            "status" =>200
         ],200);
            


    }

    public function register(Request $request){
 

        $mobile = $request->mobile;
        $name = $request->name;
        $family = $request->family;

        if(!isset($mobile ))
        return response([
           "data"=>"وارد کردن شماره موبایل الزامی است ",
           "status" =>422
        ],422);
  


        if(!$mobile  || strlen($mobile)!=11)
         return response([
            "data"=>"فرمت موبایل وارد شده صحیح نمی باشد ",
            "status" =>422
         ],422);
   

         if(!isset($name)  )
         return response([
            "data"=>"وارد کردن نام الزامی می باشد! ",
            "status" =>422
         ],422);

         if(!isset($family)  )
         return response([
            "data"=>"!وارد کردن نام خانوادگی الزامی می باشد",
            "status" =>422
         ],422);

         $user = User::whereMobile($mobile)->first();

         if($user &&  $user->auth) 
         return response([
            "data"=>"شما قبلا ثبت نام کردید ! ",
            "status" =>422
         ],422);
           
         if(!$user)
         $user = User::create(
            [
                "name"=>$name,
                "family"=>$family,
                "mobile"=>$mobile,
            ]
         );

         $code = rand(100000,999999) ;
         $inputs = [
            "user_id"=>$user->id,
            "mobile"=>$mobile,
            "code"=>$code,
            "type"=>"auth",
         ];
         $sms = SmsLog::create($inputs);

         return response([
            "data"=>"کد فعالسازی به شماره موبایل شما ارسال شد",
            "status" =>200
         ],200);
            


    }

    public function verify(Request $request){

        $type = $request->type;
        $mobile = $request->mobile;
        $code = $request->code;

        if(!$type || !$mobile)
        return response([
            "data"=>"اطلاعات ورودی کامل نمی باشد",
            "status" =>422
         ],422);

         
        if($type!="login" &&  $type!="register")
        return response([
            "data"=>"نوع فعالسازی صحیح نمی باشد!",
            "status" =>422
         ],422);

         if(!$mobile  || strlen($mobile)!=11)
         return response([
            "data"=>"فرمت موبایل وارد شده صحیح نمی باشد ",
            "status" =>422
         ],422);
   

         $user = User::whereMobile($mobile)->first();

         if(!$user)
         return response([
            "data"=>"اطلاعلات کاربری صحیح نمی باشد",
            "status" =>404
         ],404);

         $sms = SmsLog::whereMobile($mobile)
         ->whereIs_used('0')
         ->whereType("auth")->whereCode($code)->latest()->first();
         if(!$sms)
         return response([
            "data"=>"کد وارد شده صحیح نمی باشد",
            "status" =>404
         ],404);

         $sms->update(["is_used"=>"1"]);

         if($type=="register")
         $user->update(["auth"=>true]);

         $user->update(["api_token"=>Str::random(100)]);
         

        
         return new UserResource($user);

   

    }
}
