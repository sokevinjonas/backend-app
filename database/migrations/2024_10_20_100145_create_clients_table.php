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
            $table->string('numero_client');
            $table->string('nom');
            $table->string('pays');
            $table->string('telephone');
            $table->string('sexe');
            $table->date('dateAnniv');
            $table->timestamps();
            $table->timestamp('sync_timestamp')->nullable();
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
