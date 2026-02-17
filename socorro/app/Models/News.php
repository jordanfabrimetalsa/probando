<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news_main';
    protected $fillable = ['title', 'slug', 'description', 'image', 'user_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(CategoriesNews::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
