<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistResponse extends Model
{
    protected $table = 'checklist_response';

    public function QuestionCheck(){
        return $this->belongsTo(QuestionCheck::class);
    }

    public function CategoriesCheck(){
        return $this->belongsTo(CategoriesCheck::class);
    }
}
