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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('Review_id');
            $table->foreignId('Paper_id')->references('Paper_id')->on('papers');
            $table->foreignId('Reviewer_id')->references('Reviewer_id')->on('reviewers');
            $table->integer('originality')->nullable();
            $table->integer('relevance')->nullable();
            $table->integer('suitable')->nullable();
            $table->integer('findings')->nullable();
            $table->integer('reference')->nullable();
            $table->integer('language')->nullable();
            $table->integer('total')->nullable();
            $table->enum('status', ['To Review', 'Reviewed'])->default('To Review');
            $table->string('p_status')->default("-");
            $table->string('comment', 2000)->nullable();
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
        Schema::dropIfExists('reviews');
    }
};
