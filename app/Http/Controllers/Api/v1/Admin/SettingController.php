<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\Collection\SettingCollection;
use App\Http\Resources\v1\Admin\Resource\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $settings =  Setting::orderBy($order, $desc)->paginate(20);

        return new SettingCollection($settings);

        
    }
    public function create(Request $request)
    {

        $inputs = [
            "phone" => $request->phone,
            "mobile" => $request->mobile,
            "address" => $request->address,
            "youtube" => $request->youtube,
            "instagram" => $request->instagram,
            "linkedin" => $request->linkedin,
            "twitter" => $request->twitter,
            "description" => $request->description,
            "about" => $request->about,
            "contact" => $request->contact
        ];
        $setting = Setting::create($inputs);
        return response([
            "data" => "setting created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, Setting $setting)
    {

        $inputs = [
            "phone" => $request->phone,
            "mobile" => $request->mobile,
            "address" => $request->address,
            "youtube" => $request->youtube,
            "instagram" => $request->instagram,
            "linkedin" => $request->linkedin,
            "twitter" => $request->twitter,
            "description" => $request->description,
            "about" => $request->about,
            "contact" => $request->contact
        ];
        $setting->update($inputs);
        return response([
            "data" => "setting updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(Setting $setting)
    {
        
        return new SettingResource($setting);
      
    }
    public function delete(Setting $setting)
    {
        $setting->delete();
        return response([
            "data" => "setting deleted successfully",
            "status" => 200
        ], 200);
    }
}
