<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionLog extends Migration
{
    public function up()
    {
        Schema::create('transactions_log', function (Blueprint $table) {

            $table->id();
            $table->float('last_amount', 12,2);
            $table->float('new_amount', 12,2 );
            $table->bigInteger('account_user_id')->unsigned();
            $table->timestamps();
            $table->foreign('account_user_id')->references('id')->on('users');

        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions_log');
    }
}
