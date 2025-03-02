<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCarrieresTable  extends Migration
{
    public function up()
    {
        Schema::create('carrieres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('promotion')->nullable();
            $table->decimal('augmentation', 10, 2)->nullable();
            $table->foreignId('formation_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrieres');
    }
}
