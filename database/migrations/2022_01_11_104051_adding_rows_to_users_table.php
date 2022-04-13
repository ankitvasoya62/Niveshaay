<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddingRowsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function ($table) {
                if(Schema::hasColumn('users', 'phone_no') == false){
                    $table->string('phone_no')->after('remember_token')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'pan')  == false){
                    $table->string('pan')->after('phone_no')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'dob')  == false){
                    $table->string('dob')->after('pan')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'smallcase_name')  == false){
                    $table->string('smallcase_name')->after('dob')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'subscription_status')  == false){
                    $table->string('subscription_status')->after('smallcase_name')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'subscription_start_date')  == false){
                    $table->string('subscription_start_date')->after('subscription_status')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'subscription_end_date')  == false){
                    $table->string('subscription_end_date')->after('subscription_start_date')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'subscription_plan')  == false){
                    $table->string('subscription_plan')->after('subscription_end_date')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'amount')  == false){
                    $table->string('amount')->after('subscription_plan')->nullable()->default(NULL);
                }
                if(Schema::hasColumn('users', 'broker')  == false){
                    $table->string('broker')->after('amount')->nullable()->default(NULL);
                }
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
