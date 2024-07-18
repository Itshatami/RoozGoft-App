<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    use HasFactory,SoftDeletes;

    protected $table = "articles";
    protected $guarded = [];

    // User - inverse
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
