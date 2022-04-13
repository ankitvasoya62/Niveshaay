<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentMonthComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_month_complaints', function (Blueprint $table) {
            $table->id();
            $table->string('received_from')->nullable();
            $table->integer('month')->default(0);
            $table->integer('year')->default(0);
            $table->integer('pending_last_month')->default(0);
            $table->integer('received')->default(0);
            $table->integer('resolved')->default(0);
            $table->integer('total_pending')->default(0);
            $table->integer('pending_3m')->default(0);
            $table->integer('avg_resolution_time')->default(0);

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
        Schema::dropIfExists('current_month_complaints');
    }
}
