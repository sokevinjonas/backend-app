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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('matricule_user');
            $table->string('numero_client')->unique();
            $table->string('nom');
            $table->string('pays');
            $table->string('telephone');
            $table->string('sexe');
            $table->date('dateAnniv');
            $table->timestamps();
            $table->foreign('matricule_user')->references('matricule')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
