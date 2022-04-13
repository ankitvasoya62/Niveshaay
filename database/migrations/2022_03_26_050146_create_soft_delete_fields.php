<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftDeleteFields extends Migration
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
            $table->softDeletes();

        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->softDeletes();

        });
        Schema::table('share_details', function (Blueprint $table) {
            //
            $table->softDeletes();

        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('soft_delete_fields');
    }
}
