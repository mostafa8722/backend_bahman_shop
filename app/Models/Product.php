<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "user_id",
        "seller_id",
        "title",
        'en_title',
        "discription",
        "abstract",
        "colors",
        "images",
        "guaranti",
        "limited_number",
        "isAvailable",
        "status",
        "features",
        "details",
        "price",
        "discount",
        "colors",
        "sizes",
        "viewed",

    ];

    protected $casts = [
        "images"=> 'array',
        "details"=> 'array',
        "features"=> 'array',
        "colors"=> 'array',
        "sizes"=> 'array'];
}
