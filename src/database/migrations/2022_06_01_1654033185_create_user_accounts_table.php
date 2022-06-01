<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {

        $table->id();
        $table->integer('account_number');
		$table->tinyInteger('account_status')->default('1');
		$table->float('account_current_amount',12,2)->default('0');
		$table->unsignedBigInteger('account_user_id')->unsigned();
        $table->timestamps();
		$table->foreign('account_user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_accounts');
    }
}
