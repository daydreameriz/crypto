<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique();
            $table->double('last_price')->nullable();
            $table->double('daily_change')->nullable();
            $table->double('daily_change_percent')->nullable();
            $table->double('daily_high')->nullable();
            $table->double('daily_low')->nullable();
            $table->timestamps();
        });

        Schema::create('crypto_currency_user', function (Blueprint $table) {
            $table->unsignedBigInteger('crypto_currency_id')->index();
            $table->unsignedBigInteger('user_id')->index();

            $table->unique(['crypto_currency_id', 'user_id']);
            $table->foreign('crypto_currency_id')->references('id')->on('crypto_currencies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crypto_currencies');
        Schema::dropIfExists('crypto_currency_user');
    }
}
