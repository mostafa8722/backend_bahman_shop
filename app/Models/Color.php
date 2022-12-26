<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Color extends Model
{
    protected $fillable = [
        "title","value",
        'en_title',
    
    ];
}
