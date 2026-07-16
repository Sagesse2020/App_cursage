<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('achats', function (Blueprint $table) {

            // Nouvelle clé étrangère
            $table->foreignId('fournisseur_id')
                ->nullable()
                ->after('user_id')
                ->constrained()
                ->nullOnDelete();


        });


        // Supprimer l'ancien champ texte
        Schema::table('achats', function (Blueprint $table) {

            $table->dropColumn('fournisseur');

        });

    }



    public function down(): void
    {

        Schema::table('achats', function (Blueprint $table) {


            $table->dropForeign([
                'fournisseur_id'
            ]);


            $table->dropColumn(
                'fournisseur_id'
            );


            $table->string('fournisseur')
                ->nullable();


        });

    }

};
