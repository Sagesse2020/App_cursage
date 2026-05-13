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

    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    $table->string('produit_nom');
    $table->integer('quantite');
    $table->decimal('prix_unitaire', 10, 2);
    $table->decimal('montant_total', 10, 2);

    $table->enum('mode_paiement', ['cash','mobile_money','carte']);
    $table->enum('statut', ['en_attente','validee','annulee'])->default('en_attente');

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
