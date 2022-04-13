<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortDescriptionColumnToOurResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('our_research', function (Blueprint $table) {
            //
            if(Schema::hasColumn('our_research', 'short_description')  == false){
                $table->text('short_description')->after('description')->nullable();
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
        Schema::table('our_research', function (Blueprint $table) {
            //
        });
    }
}
