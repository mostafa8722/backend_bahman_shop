<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MotherController extends Controller
{
    public function uploadFile($file,$type,$filename){


        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        // $imagePath = "/uploads/users/";

        $path = "/uploads/files/${type}/{$year}/{$month}/{$day}/";
        
        $file->getClientOriginalName();
         $file->move(public_path($path),$filename);
        return $path.$filename;

    }
}
