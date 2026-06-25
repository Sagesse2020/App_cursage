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
        Schema::create('partenaires', function (Blueprint $table) {

    $table->id();

    $table->string('nom');
    $table->string('prenom')->nullable();

    $table->string('telephone');
    $table->string('email')->nullable();

    $table->string('photo')->nullable();

    $table->enum('type_partenaire',[
        'vendeur',
        'apporteur_affaires'
    ]);

    $table->decimal('commission',10,2)
          ->default(0);

    $table->string('entreprise')->nullable();

    $table->text('adresse')->nullable();

    $table->enum('statut',[
        'actif',
        'suspendu',
        'inactif'
    ])->default('actif');

    $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
