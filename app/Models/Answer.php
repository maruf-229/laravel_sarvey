<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'survey_id',
        'survey_unq_id',
        'question_id',
        'answer',
        'created_at',
    ];
}
