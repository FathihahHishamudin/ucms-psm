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
        Schema::create('normal_participants', function (Blueprint $table) {
            $table->id('Participant_id')->primary();
            $table->string('User_id')->constraint('users')->onDelete("cascade");
            $table->string('Conference_id')->constraint('conferences')->onDelete("cascade");
            $table->string('Payment_id')->constraint('payments')->OnDelete("cascade");
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
        Schema::dropIfExists('normal__participants');
    }
};
