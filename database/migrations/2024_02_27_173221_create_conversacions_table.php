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
        Schema::create('conversacions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('remitente_id');
            $table->unsignedBigInteger('receptor_id');
            $table->foreign('remitente_id')->references('id')->on('users');
            $table->foreign('receptor_id')->references('id')->on('users');
            $table->timestamp('last_time_message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversacions');
    }
};
