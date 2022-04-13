<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnsToOurResearchTable extends Migration
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
            if(Schema::hasColumn('our_research', 'status')  == false){
                $table->enum('status',['active','inactive','deleted'])->after('image_path')->default('active');    
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
