<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_form_details', function (Blueprint $table) {
            //
            $table->enum('status',['active','inactive','deleted'])->after('is_email_verified')->default('active');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_form_details', function (Blueprint $table) {
            //
        });
    }
}
