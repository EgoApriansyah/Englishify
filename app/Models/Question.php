<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'section',
    'sub_type',
    'passage_id',
    'order_number',
    'transcript',
    'question_text',
    'option_a',
    'option_b',
    'option_c',
    'option_d',
    'correct_answer'
])]
class Question extends Model
{
    public function passage(): BelongsTo
    {
        return $this->belongsTo(Passage::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
