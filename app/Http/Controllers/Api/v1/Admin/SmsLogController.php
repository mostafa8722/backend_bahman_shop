<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\Admin\Resources\SmsLogResource;
use App\Models\SmsLog;
use Illuminate\Http\Request;

class SmsLogController extends Controller
{
    
    public function index(Request $request)
    {

        $order = "id";
        $desc = "DESC";

        if (isset($request->order))
            $order  = $request->order;

        if (isset($request->desc))
            $order  = $request->desc;

        $smsLogs =  SmsLog::orderBy($order, $desc)->paginate(20);

        
        return new SmsLogController($smsLogs);
    }
    public function create(Request $request)
    {

        $inputs = [
            "mobile" => $request->mobile,
            "user_id" => $request->user_id,
            "code" => $request->code,
            "is_used" => $request->is_used,
            "type" => $request->type,
        ];

        $smsLog = SmsLog::create($inputs);


        return response([
            "data" => "smsLog created successfully",
            "status" => 200
        ], 200);
    }

    public function update(Request $request, SmsLog $smsLog)
    {

      
    $inputs = [
        "mobile" => $request->mobile,
        "user_id" => $request->user_id,
        "code" => $request->code,
        "is_used" => $request->is_used,
        "type" => $request->type,
    ];


    

        $smsLog->update($inputs);


        return response([
            "data" => "smsLog updated successfully",
            "status" => 200
        ], 200);
    }
    public function single(SmsLog $smsLog)
    {

        return new SmsLogResource($smsLog);
    }
    public function delete(SmsLog $smsLog)
    {



        $smsLog->delete();
        return response([
            "data" => "smsLog deleted successfully",
            "status" => 200
        ], 200);
    }

}
