<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsEmailVerifiedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_form_details', function (Blueprint $table) {
            //
            if(Schema::hasColumn('subscription_form_details', 'is_email_verified')  == false){
                $table->boolean('is_email_verified')->after('understand_risk_reward')->default(FALSE);
                
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
        Schema::table('subscription_form_details', function (Blueprint $table) {
            //
        });
    }
}
