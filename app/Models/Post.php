<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [     
        'category',
        'user_id',
        'title',
        'en_title',
        'body',
       
        'image',
     ];
}
