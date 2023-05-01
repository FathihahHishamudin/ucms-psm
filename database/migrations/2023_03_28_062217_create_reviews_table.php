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
            $table->string('Paper_id')->constraint('papers')->onDelete("cascade");
            $table->string('Reviewer_id')->constraint('reviewers');
            $table->integer('Review_Originality');
            $table->integer('Review_Relevance');
            $table->integer('Review_Suitable');
            $table->integer('Review_Findings');
            $table->integer('Review_Language');
            $table->integer('Review_Marks');
            $table->integer('Review_result');
            $table->string('Review_comment');
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
