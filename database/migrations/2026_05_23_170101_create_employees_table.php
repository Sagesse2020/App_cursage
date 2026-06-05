<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->id();

            $table->string('nom');

            $table->string('prenom');

            $table->string('telephone')->nullable();

            $table->string('email')->nullable();

            $table->string('poste');

            $table->decimal('salaire',10,2)->default(0);

            $table->date('date_embauche');

            $table->string('photo')->nullable();

            $table->enum('statut',[
                'actif',
                'suspendu',
                'demission',
            ])->default('actif');

            $table->text('adresse')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};