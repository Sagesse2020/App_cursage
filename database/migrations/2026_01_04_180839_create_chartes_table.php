<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chartes', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->default('Charte d’équipe CURSAGE');
            $table->longText('contenu')->nullable();
            $table->date('date_signature')->nullable();
            $table->boolean('signe_elysee')->default(false);
            $table->boolean('signe_associe')->default(false);
            $table->enum('statut', ['active', 'en_modif'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chartes');
    }
};
