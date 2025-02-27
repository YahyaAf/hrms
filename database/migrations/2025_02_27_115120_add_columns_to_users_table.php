<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->nullable();
            $table->date('date_naissance')->nullable();
            $table->text('adresse')->nullable();
            $table->decimal('salaire', 10, 2)->nullable();
            $table->string('statut')->nullable();
            $table->foreignId('contract_id')->nullable()->constrained('contracts')->nullOnDelete();
            $table->foreignId('departement_id')->nullable()->constrained('departements')->nullOnDelete();
            $table->foreignId('emploi_id')->nullable()->constrained('emplois')->nullOnDelete();
            $table->foreignId('grade_id')->nullable()->constrained('grades')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'date_naissance', 'adresse', 'salaire', 'statut']);
            $table->dropForeign(['contract_id']);
            $table->dropForeign(['departement_id']);
            $table->dropForeign(['emploi_id']);
            $table->dropForeign(['grade_id']);
        });
    }
};
