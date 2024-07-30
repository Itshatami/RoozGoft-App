<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Role
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    // Profile
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    // Articles - direct!
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    // Posts - direct!
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Quizzes - direct!
    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    // QuizAttempt - direct!
    public function quizattempts(): HasMany
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
