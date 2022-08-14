<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';
    protected $guarded = ['id'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function debitTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'from_wallet', 'id');
    }

    public function creditTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'to_wallet', 'id');
    }
}
