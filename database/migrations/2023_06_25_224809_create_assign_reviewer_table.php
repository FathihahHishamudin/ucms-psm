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
        Schema::create('assign_reviewer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Conference_id')->references('Conference_id')->on('conferences');
            $table->foreignId('Paper_id')->references('Paper_id')->on('papers');
            $table->foreignId('User_id')->references('id')->on('users');
            $table->enum('status', ['Pending', 'Accept', 'Reject'])->default('Pending');
            $table->date('due');
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
        Schema::dropIfExists('assign_reviewer');
    }
};
