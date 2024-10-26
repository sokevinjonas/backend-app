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
            $table->enum('status', ['attente', 'pret', 'urgente', 'annuler', 'livrer']);
            $table->string('numero_client');
            $table->text('detail');
            $table->text('besoin');
            $table->decimal('total', 10, 2);
            $table->decimal('avance', 10, 2);
            $table->decimal('reste', 10, 2);
            $table->date('livraison');
            $table->json('photos')->nullable();
            $table->timestamps();
            $table->timestamp('sync_timestamp')->nullable();
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
