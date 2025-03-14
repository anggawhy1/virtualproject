<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('user_rewards', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('reward_id');
        $table->timestamp('redeemed_at');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('reward_id')->references('id')->on('rewards')->onDelete('cascade');
        $table->string('status');
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
        Schema::dropIfExists('user_rewards');
    }
}
