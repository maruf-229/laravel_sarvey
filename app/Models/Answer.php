<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_unq_id',
        'survey_id',
        'survey_unq_id',
        'question_id',
        'answer',
        'created_at',
    ];

    public function question(){
        return $this->belongsTo(Question::class,'question_id','id');
    }
}
