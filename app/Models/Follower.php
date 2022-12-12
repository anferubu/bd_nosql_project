<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Follower extends MongoModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'follower_id',
    ];
}
