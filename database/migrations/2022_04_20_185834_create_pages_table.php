<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('bg_image');
            $table->timestamps();
        });
        Schema::create('content', function (Blueprint $table) {
            $table->foreignId('pages_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('language');
            $table->string('name');
            $table->string('title');
            $table->string('main_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
        Schema::dropIfExists('pages');
    }
};
