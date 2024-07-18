<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "quiz_attempts";
    protected $guarded = [];

    // User - inverse
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Quiz - inverse
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
