<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubResearchImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_research_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('research_image_id')->unsigned()->nullable();
            $table->string('report_image_path')->nullable();
            $table->timestamps();
            $table->foreign('research_image_id')->references('id')->on('research_images')->ondelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_research_images');
    }
}
