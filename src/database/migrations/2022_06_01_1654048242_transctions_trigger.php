<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TransctionsTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE DEFINER=`phper`@`%` TRIGGER log_transactions
            AFTER UPDATE ON user_accounts FOR EACH ROW
            BEGIN
                INSERT INTO transactions_log (last_amount, new_amount, account_user_id) VALUES (old.account_current_amount, new.account_current_amount, new.account_user_id);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `log_transactions`');

    }
}
