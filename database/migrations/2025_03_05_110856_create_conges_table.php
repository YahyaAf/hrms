<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('jours_demandes'); 
            $table->enum('statut', ['En attente', 'Approuvé', 'Rejeté'])->default('En attente');
            $table->boolean('validation_manager')->default(false); 
            $table->boolean('validation_rh')->default(false); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conges');
    }
};

