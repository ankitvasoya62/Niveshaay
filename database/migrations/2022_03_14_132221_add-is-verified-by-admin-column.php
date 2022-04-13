<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsVerifiedByAdminColumn extends Migration
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
            if(Schema::hasColumn('subscription_form_details', 'is_verified_by_admin')  == false){
                $table->boolean('is_verified_by_admin')->after('is_email_verified')->default(FALSE);
                
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
