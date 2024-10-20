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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('matricule_user');
            $table->string('status');
            $table->string('numero_client');
            $table->text('detail');
            $table->text('besoin');
            $table->decimal('total', 10, 2);
            $table->decimal('avance', 10, 2);
            $table->decimal('reste', 10, 2);
            $table->date('livraison');
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
        Schema::dropIfExists('commandes');
    }
};
