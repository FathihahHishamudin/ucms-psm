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
        Schema::create('area_of_interest_papers', function (Blueprint $table) {
            $table->id('AoIp_id');
            $table->string('Paper_id')->constraint('conferences')->onDelete("cascade");
            $table->string('AoI_id')->constraint('area_of_interest')->onDelete("cascade");
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
        Schema::dropIfExists('areaof_interestfor_papers');
    }
};
