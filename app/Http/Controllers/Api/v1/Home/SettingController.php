<?php

namespace App\Http\Controllers\Api\v1\Home;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    
    public function single(){
        $setting=  Setting::latest()->first();

        return response([
            "data"=>$setting,
            "status"=>200
        ]);
    }
}
