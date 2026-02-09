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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chien_id')->constrained('chiens')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // enregistreur
            $table->decimal('prix_vente',12,2);
            $table->decimal('commission_partenaire',12,2)->default(0);
            $table->decimal('commission_cursage',12,2)->default(0);
            $table->enum('statut_payment',['non_paye','partiel','paye'])->default('non_paye');
            $table->timestamp('date_vente')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
