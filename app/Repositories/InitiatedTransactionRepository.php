<?php

namespace App\Repositories;

use App\Models\InitiatedTransaction;
use App\Models\User;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class InitiatedTransactionRepository extends BaseRepository
{
    private static InitiatedTransactionRepository $instance;
    protected string $modelName = InitiatedTransaction::class;

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // Sums conversions amount
    // Returns Highest-Amount / Total Amount of transaction for user
    // If $userId is null, $first is true, returns First Highest
    // If $userId is null, $first is false, returns total for all
    // If $userId is not null, returns total for one
    public function findUserWithCalculatedConversions(int $userId = null, bool $first = true): ?array
    {
        if (! is_null($userId) || ! $first) {
            $sumAlias = 'total_conversion';
        } else {
            $sumAlias = 'highest_conversion';
        }

        $query = $this->model->query();

        if(! is_null($userId)) {
            $query->where('from_user', $userId);
        }

        $query
            ->with( 'madeFromUser.wallet')
            ->where('type', TransactionType::C)
            ->selectRaw('from_user, SUM(CONVERT(amount_before, SIGNED)) as ' . $sumAlias)
            ->orderBy($sumAlias, 'desc')
            ->groupBy('from_user');

        if (! is_null($userId) || $first) {
            return $query->first()?->toArray();
        }

        return $query->get()?->toArray();
    }

    // Counts conversions
    // Returns transaction with Max-Count
    public function findUserWithMaxConversions(): ?array
    {
        return $this->model
            ->query()
            ->with('madeFromUser.wallet')
            ->select('from_user', DB::raw('count(from_user) as max_conversion'))
            ->where('type', TransactionType::C)
            ->orderBy('max_conversion', 'desc')
            ->groupBy('from_user')
            ->first()
            ?->toArray();
    }
}
