<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('logs_modifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('admin_id');
        $table->unsignedBigInteger('utilisateur_id')->nullable();
        $table->string('action');
        $table->text('details')->nullable();
        $table->timestamps();

        $table->foreign('admin_id')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
        $table->foreign('utilisateur_id')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
    });
}

};
