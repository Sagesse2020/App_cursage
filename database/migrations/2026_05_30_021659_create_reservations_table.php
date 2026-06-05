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
             Schema::create('reservations', function (Blueprint $table) {

    $table->id();

    $table->foreignId('client_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('chien_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->decimal('montant_avance',12,2)
          ->default(0);

    $table->decimal('reste_a_payer',12,2)
          ->default(0);

    $table->enum('statut',[
        'en_attente',
        'confirmee',
        'annulee',
        'transformee_en_vente'
    ])->default('en_attente');

    $table->date('date_reservation');

    $table->foreignId('user_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
