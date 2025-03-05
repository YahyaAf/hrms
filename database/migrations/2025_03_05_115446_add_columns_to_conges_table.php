<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('conges', function (Blueprint $table) {
            $table->enum('type_conge', ['vacances', 'maladie', 'maternité', 'autre'])->after('date_fin');
            $table->text('motif')->nullable()->after('type_conge');
        });
    }

    public function down()
    {
        Schema::table('conges', function (Blueprint $table) {
            $table->dropColumn('type_conge');
            $table->dropColumn('motif');
        });
    }
};
