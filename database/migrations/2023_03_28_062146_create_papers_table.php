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
            $table->id('Paper_id');
            $table->foreignId('Author_id')->references('Author_id')->on('authors');
            $table->foreignId('Conference_id')->references('Conference_id')->on('conferences');
            $table->string('paper_title')->nullable();
            $table->string('abstract', 2000)->nullable();
            $table->string('full_paper')->nullable();
            $table->string('review1_fp_id')->nullable();
            $table->string('review2_fp_id')->nullable();
            $table->string('stat_fp')->nullable();
            $table->string('Correction_fp')->nullable();
            $table->string('review1_cfp_id')->nullable();
            $table->string('review2_cfp_id')->nullable();
            $table->string('stat_cfp')->nullable();
            $table->string('cr_paper')->nullable();
            $table->string('status_cr')->nullable();
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
