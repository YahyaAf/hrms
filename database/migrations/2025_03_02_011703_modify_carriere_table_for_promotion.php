<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarriereTableForPromotion extends Migration
{
    public function up()
    {
        Schema::table('carrieres', function (Blueprint $table) {
            $table->dropColumn('promotion');

            $table->unsignedBigInteger('grade_id')->nullable();

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('carrieres', function (Blueprint $table) {
            $table->dropForeign(['grade_id']);
            $table->dropColumn('grade_id');
            $table->unsignedBigInteger('promotion')->nullable();
        });
    }
}

