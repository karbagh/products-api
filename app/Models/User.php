<?php

namespace App\Models;

use App\Dtoes\Users\Discount\UserDiscountDto;
use App\Enums\Payment\Status;
use App\Enums\User\Order\Discount;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasName, FilamentUser, MustVerifyEmail
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
        'phone',
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

    public function device(): HasOne
    {
        return $this->hasOne(Device::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function apiCall(): HasMany
    {
        return $this->hasMany(ApiLog::class);
    }

    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    public function getFullInfoAttribute(): string
    {
        return "{$this->fullName} / {$this->role->type}";
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getIsPartnerAttribute(): bool
    {
        return $this->partner()->exists();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class, 'used_by_id');
    }

    public function partner(): HasOne
    {
        return $this->hasOne(Partner::class);
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

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
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

    public function scopeAdmin($query): Builder
    {
        return $query->whereHas('role', function ($query) {
            $query->wherein('slug', ['super-administrator', 'administrator']);
        });
    }

    public function getIsAdminAttribute(): bool
    {
        return in_array($this->role->slug, ['super-administrator', 'administrator']);
    }

    public function canAccessFilament(): bool
    {
        return $this->isAdmin;
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

    public function priceRequests(): HasMany
    {
        return $this->hasMany(PriceRequest::class, 'user_id');
    }

    public function approvesOfPriceRequests(): HasMany
    {
        return $this->hasMany(PriceRequest::class, 'approved_by_id');
    }

    public function getDiscountDetailsAttribute(): ?UserDiscountDto
    {
        return !$this->isPartner ? Discount::level($this->orders()
            ->whereHas(
                'payment', fn(Builder $q) => $q
                ->whereIn('status', [Status::SUCCESS->value, Status::DELIVERED->value])
            )->sum('total')
        )->discountDetails() : null;
    }
}
