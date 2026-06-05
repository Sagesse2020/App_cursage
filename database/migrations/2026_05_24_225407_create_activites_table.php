<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activites', function (Blueprint $table) {

            $table->id();

            // UUID inviolable
            $table->uuid('uuid')->unique();

            // utilisateur
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // type action
            $table->string('action');

            // module concerné
            $table->string('module');

            // ID objet concerné
            $table->unsignedBigInteger('reference_id')
                ->nullable();

            // états
            $table->longText('ancien_etat')
                ->nullable();

            $table->longText('nouvel_etat')
                ->nullable();

            // sécurité
            $table->string('severity')
                ->default('info');

            // système
            $table->boolean('is_system')
                ->default(true);

            // verrouillage
            $table->timestamp('locked_at')
                ->nullable();

            // IP
            $table->string('ip')
                ->nullable();

            // navigateur
            $table->text('user_agent')
                ->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};