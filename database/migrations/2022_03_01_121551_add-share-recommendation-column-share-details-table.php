<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShareRecommendationColumnShareDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('share_details', function (Blueprint $table) {
            //
            if(Schema::hasColumn('share_details', 'share_recommendation')  == false){
                $table->string('share_recommendation')->after('share_description')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('share_details', function (Blueprint $table) {
            //
        });
    }
}
