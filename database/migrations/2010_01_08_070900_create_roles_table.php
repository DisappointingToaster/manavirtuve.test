<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('role_name');
        });
        DB::table('roles')->insert(
            ([[
                'role_name' => 'Basic_user',
            ],
            [
                'role_name' => 'Moderator',
            ],
            [
                'role_name' => 'Administrator',
            ]

            ])
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
