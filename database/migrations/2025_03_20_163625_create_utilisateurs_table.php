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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('id_utilisateur');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('email', 255)->unique();
            $table->text('mot_de_passe');
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->string('ville', 100)->nullable();
            $table->string('code_postal', 10)->nullable();
            $table->enum('type_utilisateur', ['client', 'livreur', 'commercant', 'prestataire', 'admin']);
            $table->timestamps();
        });

        Schema::create('clients', function (Blueprint $table) {
            $table->id('id_client');
            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->string('paiement_defaut', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('livreurs', function (Blueprint $table) {
            $table->id('id_livreur');
            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->string('vehicule', 100)->nullable();
            $table->boolean('statut_verification')->default(false);
            $table->text('trajets_predefinis')->nullable();
            $table->timestamps();
        });

        Schema::create('commercants', function (Blueprint $table) {
            $table->id('id_commercant');
            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->string('nom_entreprise', 255);
            $table->text('adresse')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('prestataires', function (Blueprint $table) {
            $table->id('id_prestataire');
            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->string('type_prestation', 255);
            $table->decimal('tarif', 10, 2);
            $table->json('disponibilites')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestataires');
        Schema::dropIfExists('commercants');
        Schema::dropIfExists('livreurs');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('utilisateurs');
    }
};