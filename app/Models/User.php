<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'activation_token',
        'is_active',
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
        'is_admin' => 'boolean',
    ];

    public function gravatar(string $size = '100'): string
    {
        $hash = md5(trim(strtolower($this->attributes['email'])));
        return "https://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public static function generateActivationToken()
    {
        return Str::random(10);
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(Status::class);
    }

    public function feed(): HasMany
    {
        return $this->statuses()
            ->orderBy('created_at', 'desc');
    }

}
