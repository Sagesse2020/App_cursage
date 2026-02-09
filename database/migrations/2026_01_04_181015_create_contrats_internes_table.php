<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contrats_internes', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->default('Contrat d’association CURSAGE');
            $table->longText('contenu')->nullable();
            $table->boolean('accord_elysee')->default(false);
            $table->boolean('accord_associe')->default(false);
            $table->date('date_signature')->nullable();
            $table->enum('statut', ['actif', 'archive'])->default('actif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contrats_internes');
    }
};
