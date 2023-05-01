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
        Schema::create('pc_chairs', function (Blueprint $table) {
            $table->id('Chair_id');
            $table->string('User_id')->constraint('users')->onDelete("cascade");
            $table->string('Conference_id')->constraint('conferences')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_c__chairs');
    }
};
