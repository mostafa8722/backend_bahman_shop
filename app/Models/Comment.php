<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
    'user_id',
    'product_id',
    'body',
    'rate1',
    'rate2',
    'rate3',
    'rate4',
    "total_rate",
    "status"
  ];
}
