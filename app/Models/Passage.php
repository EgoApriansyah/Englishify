<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'content'])]
class Passage extends Model
{
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
