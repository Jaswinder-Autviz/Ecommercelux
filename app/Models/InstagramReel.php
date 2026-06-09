<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramReel extends Model
{
    protected $fillable = ['thumbnail', 'reel_url', 'likes', 'status', 'sort_order'];
}
