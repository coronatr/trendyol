<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trendyol extends Model
{
    protected $table = "trendyol";
    protected $casts =[
        'categories' => 'array'
    ];
}
