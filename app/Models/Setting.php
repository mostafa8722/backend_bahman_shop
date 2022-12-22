<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        "index",
        "value",
        "type",
        "phone",
        "mobile",
        "address",
        "youtube",
        "instagram",
        "linkedin",
        "twitter",
        "description",
    ];
}
