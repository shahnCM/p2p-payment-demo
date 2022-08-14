<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    const U = 'user';
    const W = 'wallet';

    protected $table = 'transactions';
    protected $guarded = ['id'];

    public function initiatedTransaction(): HasOne
    {
        return $this->hasOne(InitiatedTransaction::class);
    }

    public function CompletedTransaction(): HasOne
    {
        return $this->hasOne(CompletedTransaction::class);
    }

    public function madeFromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user', 'id');
    }

    public function madeToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user', 'id');
    }

    public function madeFromWallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'from_wallet', 'id');
    }

    public function madeToWallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'to_wallet', 'id');
    }

    public function scopeMadeFrom($query, string $entity): BelongsTo
    {
        return match($entity) {
            self::U => $this->belongsTo(User::class, 'from_user', 'id'),
            self::W => $this->belongsTo(Wallet::class, 'from_wallet', 'id')
        };
    }

    public function scopeMadeTo($query, string $entity): BelongsTo
    {
        return match($entity) {
            self::U => $this->belongsTo(User::class, 'to_user', 'id'),
            self::W => $this->belongsTo(Wallet::class, 'to_wallet', 'id')
        };
    }
}
