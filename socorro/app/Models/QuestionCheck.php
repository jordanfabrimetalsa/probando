<?php

namespace App\Models;

use App\Models\CategoryCheck;
use Illuminate\Database\Eloquent\Model;

class QuestionCheck extends Model
{
    protected $table = 'checklist';

    public function categoryCheck()
    {
        return $this->belongsTo(CategoryCheck::class, 'id_category_check', 'id');
    }
}
