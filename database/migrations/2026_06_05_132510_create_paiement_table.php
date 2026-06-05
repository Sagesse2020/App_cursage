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
        Schema::create('paiements', function (Blueprint $table) {

    $table->id();

    $table->foreignId('reservation_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->foreignId('vente_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->foreignId('commande_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->foreignId('facture_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->foreignId('achat_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->decimal('montant',12,2);

    $table->enum('type',[
        'reservation',
        'vente',
        'commande',
        'facture',
        'achat'
    ]);

    $table->enum('mode_paiement',[
        'especes',
        'mobile_money',
        'virement',
        'carte_bancaire',
        'cheque'
    ]);

    $table->enum('statut',[
        'en_attente',
        'partiel',
        'paye',
        'annule'
    ])->default('paye');

    $table->date('date_paiement');

    $table->text('observation')->nullable();

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
        Schema::dropIfExists('paiement');
    }
};
