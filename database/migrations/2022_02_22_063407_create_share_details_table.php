<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_details', function (Blueprint $table) {
            $table->id();
            $table->string('share_title');
            $table->date('share_date')->nullable();
            $table->string('share_logo')->nullable();
            $table->string('share_image')->nullable();
            $table->string('share_industry')->nullable();
            $table->string('share_cmp')->nullable();
            $table->string('share_market_cap')->nullable();
            $table->string('share_week_high_low')->nullable();
            $table->string('shareholding_promoters')->nullable();
            $table->string('shareholding_public')->nullable();
            $table->string('research_analyst_name')->nullable();
            $table->string('research_analyst_designation')->nullable();
            $table->string('research_analyst_email')->nullable();
            $table->longText('share_description')->nullable();
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
        Schema::dropIfExists('share_details');
    }
}
