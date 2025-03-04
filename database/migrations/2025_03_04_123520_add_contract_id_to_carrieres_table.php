<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('carrieres', function (Blueprint $table) {
            $table->foreignId('contract_id')->nullable()->constrained('contracts')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('carrieres', function (Blueprint $table) {
            $table->dropForeign(['contract_id']);
            $table->dropColumn('contract_id');
        });
    }
};

