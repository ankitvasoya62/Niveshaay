<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndAmountToSubscriptionLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_logs', function (Blueprint $table) {
            //
            $table->string('title')->before('subscription_start_date')->nullable();
            $table->string('amount')->after('subscription_end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_logs', function (Blueprint $table) {
            //
        });
    }
}
