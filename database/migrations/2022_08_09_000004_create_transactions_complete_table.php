<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TransactionStatus as Status;
use App\Enums\TransactionType as Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completed_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->unique()->references('id')->on('transactions')->onUpdate('cascade');
            $table->string('amount_before');
            $table->string('amount_after');
            $table->bigInteger('from_user')->index();
            $table->bigInteger('from_wallet')->index();
            $table->bigInteger('to_user')->index();
            $table->bigInteger('to_wallet')->index();
            $table->string('conversion_rate')->nullable();
            $table->string('conversion_route')->nullable()->index();
            $table->enum('type', [Type::C, Type::T])->index();
            $table->enum('status', [Status::S, Status::F])->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completed_transactions');
    }
};
