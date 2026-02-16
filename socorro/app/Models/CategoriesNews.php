<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesNews extends Model
{
    protected $table = 'categories_news';
    protected $fillable = ['name'];
}
