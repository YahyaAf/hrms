<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCarrieresTableAddPromotionAndAugmentation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carrieres', function (Blueprint $table) {
            $table->integer('promotion')->after('user_id'); 
            $table->decimal('augmentation', 10, 2)->after('promotion'); 
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
            $table->dropColumn('promotion');
            $table->dropColumn('augmentation');
        });
    }
}
