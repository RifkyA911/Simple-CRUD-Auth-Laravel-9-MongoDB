<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'posts';
    protected $primaryKey = '_id';
    protected $fillable = [
        'title',
        'body',
        'slug',
    ];
}
