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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('matricule_user');
            $table->foreign('matricule_user')->references('matricule')->on('users')->onDelete('cascade');
            $table->enum('plan', ['basic', 'premium', 'vip']); // Le plan choisi (par exemple: 'basic', 'premium')
            $table->integer('duration'); // Durée de la souscription en mois
            $table->decimal('amount', 10, 2); // Montant payé
            $table->string('payment_method'); // Méthode de paiement ('orange-money', 'moov-money', etc.)
            $table->string('phone_number'); // Numéro de téléphone utilisé pour le paiement
            $table->enum('status', ['pending', 'active', 'expired', 'cancel'])->default('pending'); // Statut de la souscription
            $table->timestamp('starts_at')->nullable(); // Date de début de la souscription
            $table->timestamp('ends_at')->nullable(); // Date de fin de la souscription
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
