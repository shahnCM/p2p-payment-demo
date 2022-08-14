<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier(): null|string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): null|array
    {
        return [];
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }

    public function debitTransactions(): HasMany
    {
        return $this->hasMany(InitiatedTransaction::class, 'from_user', 'id');
    }

    public function creditTransactions(): HasMany
    {
        return $this->hasMany(InitiatedTransaction::class, 'to_user', 'id');
    }

    public function completedDebitTransactions(): HasMany
    {
        return $this->hasMany(CompletedTransaction::class, 'from_user', 'id');
    }

    public function completedCreditTransactions(): HasMany
    {
        return $this->hasMany(CompletedTransaction::class, 'to_user', 'id');
    }
}
