<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('origin_account_id');
            $table->integer('origin_account_number');
            $table->unsignedBigInteger('destination_account_id')->nullable();
            $table->unsignedBigInteger('external_destination_account_id')->nullable();
            $table->integer('destination_account_number');
            $table->integer('amount');
            $table->unsignedBigInteger('origin_user_id');
            $table->timestamps();

            $table->foreign('origin_user_id')->references('id')->on('users');
            $table->foreign('origin_account_id')->references('id')->on('user_accounts');
            $table->foreign('destination_account_id')->references('id')->on('user_accounts');
            $table
                ->foreign('external_destination_account_id')
                ->references('id')->on('user_external_accounts');



        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
