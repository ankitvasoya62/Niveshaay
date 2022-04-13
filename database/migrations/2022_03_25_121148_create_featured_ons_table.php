<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturedOnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_ons', function (Blueprint $table) {
            $table->id();
            $table->string('featured_image')->nullable();
            $table->date('featured_date');
            $table->string('featured_logo')->nullable();
            $table->string('featured_title')->nullable();
            $table->text('featured_description')->nullable();
            $table->string('featured_url')->nullable();
            $table->enum('status',['active','inactive','deleted'])->default('active');
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
        Schema::dropIfExists('featured_ons');
    }
}
