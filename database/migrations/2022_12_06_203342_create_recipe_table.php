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
            $table->longText('tags');
            //$table->string('image');
            $table->integer('favourites');
            //$table->integer('user');
            //$table->boolean('flagged')
            //$table->boolean('promoted');
            
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
