<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->string('patient_id')->nullable();
            $table->date('date')->nullable();
            $table->time('time_slot')->nullable();
            $table->timestamps();
            // $table->foreign('doctor_id')->references('id')->on('doctor_availabilities')->onDelete('cascade'); 
            $table->integer('status')->default(1)->comment('1 => pending', '2 => confirmed', '3 => cancelled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
