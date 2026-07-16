<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pertes', function (Blueprint $table) {

            $table->id();

            $table->enum('type',[
                'Décès',
                'Produit périmé',
                'Produit cassé',
                'Vol',
                'Annulation',
                'Autre'
            ]);

            $table->string('source');

            $table->unsignedBigInteger('source_id')->nullable();

            $table->string('libelle');

            $table->decimal('montant',12,2);

            $table->text('description')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertes');
    }
};