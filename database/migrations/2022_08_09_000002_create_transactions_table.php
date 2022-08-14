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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('amount_before');
            $table->string('amount_after');
            $table->bigInteger('from_user');
            $table->bigInteger('from_wallet');
            $table->bigInteger('to_user');
            $table->bigInteger('to_wallet');
            $table->string('conversion_rate')->nullable();
            $table->string('conversion_route')->nullable();
            $table->enum('type', [Type::C, Type::T]);
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
        Schema::dropIfExists('transactions');
    }
};
