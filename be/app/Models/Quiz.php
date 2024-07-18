<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'quizzes';
    protected $guarded = [];

    // User - inverse
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Category - inverse
    public function category(): BelongsTo
    {
        return  $this->belongsTo(Category::class);
    }

    // Question - direct!
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    // QuizAttempt - direct!
    public function quizattempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
