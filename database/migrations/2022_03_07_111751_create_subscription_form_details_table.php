<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionFormDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_form_details', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_investor');
            $table->date('dob');
            $table->string('email');
            $table->string('mobile_no');
            $table->text('street_address')->nullable();
            $table->string('state');
            $table->string('pin_code');
            $table->string('pan_no');
            $table->enum('age',[1,2,3]);
            $table->string('source_of_income');
            $table->string('currently_hold_investments');
            $table->enum('annual_income',[1,2,3,4]);
            $table->enum('repayment_of_existing_liabilities',[1,2,3]);
            $table->enum('invest_net_worth',[1,2,3]);
            $table->enum('investment_period',[1,2,3]);
            $table->enum('invest_objective',[1,2,3]);
            $table->enum('invest_average_return',[1,2,3]);
            $table->enum('risk_attitude',[1,2,3]);
            $table->enum('knowledge_experience',[1,2,3]);
            $table->boolean('confirm_legal_residental_Status');
            $table->boolean('assesed_owned_research');
            $table->boolean('understand_risk_reward');
            
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
        Schema::dropIfExists('subscription_form_details');
    }
}
