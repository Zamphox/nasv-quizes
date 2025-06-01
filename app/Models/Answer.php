<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = ['question_id', 'answer', 'is_correct'];
    protected $hidden = ['created_at', 'updated_at', 'question_id'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
