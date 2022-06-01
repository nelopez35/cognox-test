<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserExternalAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_external_accounts', function (Blueprint $table) {

            $table->id();
            $table->integer('account_number');
            $table->tinyInteger('account_status')->default('1');
            $table->tinyInteger('can_transfer')->default('1');
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
        Schema::dropIfExists('user_external_accounts');
    }
}
