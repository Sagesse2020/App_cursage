<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('decisions_urgentes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->longText('description');
            $table->foreignId('auteur_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('date_action')->useCurrent();
            $table->enum('statut_validation', ['en_attente', 'vu', 'refuse', 'valide'])->default('en_attente');
            $table->longText('justificatif')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('decisions_urgentes');
    }
};
