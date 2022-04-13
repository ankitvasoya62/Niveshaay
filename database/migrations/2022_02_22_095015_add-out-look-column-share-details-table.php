<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOutLookColumnShareDetailsTable extends Migration
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
            if(Schema::hasColumn('share_details', 'share_outlook')  == false){
                $table->text('share_outlook')->after('share_week_high_low')->nullable();
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
