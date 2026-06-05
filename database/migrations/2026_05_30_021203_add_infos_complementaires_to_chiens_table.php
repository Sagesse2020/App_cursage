<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chiens', function (Blueprint $table) {

            $table->enum('sexe', [
                'male',
                'femelle'
            ])->nullable()->after('nom');

            $table->date('date_naissance')
                  ->nullable()
                  ->after('sexe');

            $table->decimal('poids',8,2)
                  ->nullable()
                  ->after('date_naissance');

            $table->string('couleur')
                  ->nullable()
                  ->after('poids');

            $table->string('numero_puce')
                  ->nullable()
                  ->unique()
                  ->after('couleur');

            $table->string('numero_pedigree')
                  ->nullable()
                  ->after('numero_puce');
        });
    }

    public function down(): void
    {
        Schema::table('chiens', function (Blueprint $table) {

            $table->dropColumn([
                'sexe',
                'date_naissance',
                'poids',
                'couleur',
                'numero_puce',
                'numero_pedigree'
            ]);

        });
    }
};