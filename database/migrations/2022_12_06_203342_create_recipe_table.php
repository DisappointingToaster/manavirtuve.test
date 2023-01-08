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
        Schema::create('recipe', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->longText('description');
            $table->longText('tags')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('favourites');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('flagged');
            $table->boolean('promoted');
            $table->boolean('hidden');
            $table->boolean('forcedHidden');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe');
    }
};
