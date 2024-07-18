<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "questions";
    protected $guarded = [];

    // Quiz - inverse
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    // Option - direct
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}
