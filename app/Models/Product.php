<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'name', 'price', 'category', 'description','image_url'
    ];
    protected $visible = [
        'id', 'name', 'price', 'category', 'description','image_url'
    ];

}