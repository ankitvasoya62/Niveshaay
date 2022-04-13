<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweeterFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweeter_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('tweeter_name')->nullable();
            $table->string('tweeter_username')->nullable();
            $table->string('tweeter_user_image')->nullable();
            $table->string('tweeter_description')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('tweeter_feeds');
    }
}
