<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompletedTransaction extends Model
{
    use HasFactory;

    const U = 'user';
    const W = 'wallet';

    protected $table = 'completed_transactions';
    protected $guarded = ['id'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
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
}
