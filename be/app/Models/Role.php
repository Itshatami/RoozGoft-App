<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'rules';
    protected $guarded = [];

    // User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
