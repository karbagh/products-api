<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasName, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
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

    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    public function getFullInfoAttribute(): string
    {
        return "{$this->fullName} / {$this->role->type}";
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'favorite_products',
            'user_id',
            'product_id',
        )->groupBy('product_id');
    }

    public function verify(): void
    {
        $this->email_verified_at = now();
        $this->save();

        $this->verifications()->delete();
    }

    public function unverify(): void
    {
        $this->email_verified_at = null;
        $this->save();

        $this->verifications()->delete();
    }

    public function verifications(): HasMany
    {
        return $this->hasMany(VerifyToken::class);
    }

    public function makeVerification(string $verifyString): void
    {
        $this->verifications()->create([
            'token' => bcrypt($verifyString),
        ]);
    }

    public function getFilamentName(): string
    {
        return $this->fullName;
    }
}
