<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];

    // Quize - inverse done!
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
