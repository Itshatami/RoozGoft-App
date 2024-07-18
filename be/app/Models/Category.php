<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory ,SoftDeletes;

    protected $table = 'categories';
    protected $guarded = [];

    // Quize - inverse done!
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }
}
