<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnuallyComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annually_complaints', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->default(0);
            $table->integer('carried_forward')->default(0);
            $table->integer('received')->default(0);
            $table->integer('resolved')->default(0);
            $table->integer('pending')->default(0);
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
        Schema::dropIfExists('annually_complaints');
    }
}
