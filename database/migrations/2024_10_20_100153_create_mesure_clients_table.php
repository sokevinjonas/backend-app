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
        Schema::create('mesure_clients', function (Blueprint $table) {
            $table->id();
            $table->string('matricule_user');
            $table->string('numero_client');
            $table->json('mesures');
            $table->foreign('matricule_user')->references('matricule')->on('users')->onDelete('cascade');
            $table->foreign('numero_client')->references('numero_client')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesure_clients');
    }
};
