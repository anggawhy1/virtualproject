<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('lokasi')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user'); 
            $table->string('gender')->nullable(); 
            $table->string('profile_photo')->nullable();
            $table->integer('points')->default(0);
            $table->date('tanggal_lahir')->nullable();
            $table->unsignedBigInteger('badge_id')->nullable();
            $table->unsignedBigInteger('badge_id')->default(1);
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
