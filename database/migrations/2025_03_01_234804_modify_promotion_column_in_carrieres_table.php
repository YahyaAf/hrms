<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPromotionColumnInCarrieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carrieres', function (Blueprint $table) {
            $table->string('promotion')->change(); // Change promotion to string
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carrieres', function (Blueprint $table) {
            $table->integer('promotion')->change(); // Revert promotion back to integer
        });
    }
}
