<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('laporans', function (Blueprint $table) {
            $table->bigInteger('id')->primary(); 
            $table->text('deskripsi');
            $table->string('lokasi')->nullable(); 
            $table->decimal('latitude', 10, 7)->nullable(); 
            $table->decimal('longitude', 10, 7)->nullable(); 
            $table->enum('status', [
                'Diajukan',
                'Diproses',
                'Disetujui'
            ])->default('Diajukan');
            $table->json('files')->nullable();  
            $table->unsignedBigInteger('user_id')->nullable(); // Menggunakan ID biasa (unsignedBigInteger) untuk user_id
            $table->unsignedBigInteger('kategori_id'); // Menggunakan ID biasa untuk kategori_id
            $table->boolean('anonim')->default(false); 
            $table->timestamps();

            // Foreign key dengan ID biasa
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
