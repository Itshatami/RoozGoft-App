<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $guarded = [];

    // User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
