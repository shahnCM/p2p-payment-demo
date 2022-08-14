<?php        //

namespace Database\Seeders;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\InitiatedTransaction;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitiatedTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InitiatedTransaction::insert([
            [
                'transaction_id' => 1,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 1,
                'to_wallet' => 1,
                'amount_before' => '350',
                'amount_after' => '35000',
                'conversion_route' => 'USD>BDT',
                'conversion_rate' => '100',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 2,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 1,
                'to_wallet' => 1,
                'amount_before' => '35',
                'amount_after' => '3080',
                'conversion_route' => 'USD>BDT',
                'conversion_rate' => '88',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 3,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 1,
                'to_wallet' => 1,
                'amount_before' => '350',
                'amount_after' => '34650',
                'conversion_route' => 'USD>BDT',
                'conversion_rate' => '99',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 4,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 1,
                'to_wallet' => 1,
                'amount_before' => '50',
                'amount_after' => '4250',
                'conversion_route' => 'USD>BDT',
                'conversion_rate' => '85',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 5,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 1,
                'to_wallet' => 1,
                'amount_before' => '135',
                'amount_after' => '14850',
                'conversion_route' => 'USD>BDT',
                'conversion_rate' => '110',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 6,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 1,
                'to_wallet' => 1,
                'amount_before' => '250',
                'amount_after' => '28750',
                'conversion_route' => 'USD>BDT',
                'conversion_rate' => '115',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 7,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 3,
                'to_wallet' => 3,
                'amount_before' => '350',
                'amount_after' => '342.02',
                'conversion_route' => 'USD>EU',
                'conversion_rate' => '0.9772',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_id' => 8,
                'from_user' => 2,
                'from_wallet' => 2,
                'to_user' => 3,
                'to_wallet' => 3,
                'amount_before' => '435',
                'amount_after' => '425.082',
                'conversion_route' => 'USD>EU',
                'conversion_rate' => '0.9772',
                'type' => TransactionType::C,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
