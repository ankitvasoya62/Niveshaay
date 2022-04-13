<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncludeOurResearchColumnAndShortDescriptionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('share_details', function (Blueprint $table) {
            //
            if(Schema::hasColumn('share_details', 'copy_to_our_research')  == false){
                $table->boolean('copy_to_our_research')->after('share_description')->default(FALSE);
                
            }
            if(Schema::hasColumn('share_details', 'short_description')  == false){
                $table->text('short_description')->after('copy_to_our_research')->nullable();
                
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
        //
    }
}
