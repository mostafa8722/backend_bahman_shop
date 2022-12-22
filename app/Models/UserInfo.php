<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
         "name",
         "family",
         "national_code",
         "phone",
         "user_id",
         "type",
       ];
}
