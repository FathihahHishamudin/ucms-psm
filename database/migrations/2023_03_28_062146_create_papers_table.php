<?php

use App\Models\Conference;
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
        Schema::create('papers', function (Blueprint $table) {
            $table->id('Paper_id')->primary();
            $table->string('Author_id')->constraint('authors')->onDelete('cascade');
            $table->string('Conference_id')->constraint('conferences')->onDelete('cascade');
            $table->string('Paper_title');
            $table->string('Abstract');
            $table->string('Review1_id')->constraint('reviews')->onUpdate('cascade');
            $table->string('Status_abstract');
            $table->string('Full_paper');
            $table->string('Review2_id')->constraint('reviews')->onUpdate('cascade');
            $table->string('Status_fullpaper');
            $table->string('CR_paper');
            $table->string('Status_cr');
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
        Schema::dropIfExists('papers');
    }
};
