<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {

            $table->id();

            // relation avec la vente
            $table->foreignId('vente_id')
                  ->nullable()
                  ->constrained('ventes')
                  ->nullOnDelete();

            // numéro de facture unique
            $table->string('numero')->unique();

            // client
            $table->foreignId('client_id')
                  ->nullable()
                  ->constrained('clients')
                  ->nullOnDelete();

            // date facture
            $table->date('date');

            // total
            $table->decimal('total', 12, 2)->default(0);

            // statut
            $table->enum('statut',[
                'brouillon',
                'envoyee',
                'payee',
                'annulee'
            ])->default('brouillon');

            // stockage PDF futur
            $table->string('chemin_fichier')->nullable();

            // type
            $table->string('type')->default('vente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
