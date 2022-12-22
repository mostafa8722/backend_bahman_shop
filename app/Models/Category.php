<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [     
    'parent_id',
    'user_id',
    'title',
    'en_title',
    'body',
    'level',
    'image',
 ];
