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
        Schema::disableForeignKeyConstraints();
        Schema::create('papers', function (Blueprint $table) {
            $table->id('Paper_id');
            $table->foreignId('Author_id')->references('Author_id')->on('authors');
            $table->foreignId('Conference_id')->references('Conference_id')->on('conferences');
            $table->string('r1_id')->nullable()->constraint('reviewers')->onDelete("set null");
            $table->string('r2_id')->nullable()->constraint('reviewers')->onDelete("set null");
            $table->string('paper_title')->nullable();
            $table->string('abstract', 2000)->nullable();
            $table->string('full_paper')->nullable();
            $table->unsignedBigInteger('review1_fp_id')->nullable();
            $table->foreign('review1_fp_id')->references('Review_id')->on('reviews');
            $table->unsignedBigInteger('review2_fp_id')->nullable();
            $table->foreign('review2_fp_id')->references('Review_id')->on('reviews');
            $table->string('stat_fp')->nullable();
            $table->string('Correction_fp')->nullable();
            $table->unsignedBigInteger('review1_cfp_id')->nullable();
            $table->foreign('review1_cfp_id')->references('Review_id')->on('reviews');
            $table->unsignedBigInteger('review2_cfp_id')->nullable();
            $table->foreign('review2_cfp_id')->references('Review_id')->on('reviews');
            $table->string('stat_cfp')->nullable();
            $table->string('cr_paper')->nullable();
            $table->string('status_cr')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
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
