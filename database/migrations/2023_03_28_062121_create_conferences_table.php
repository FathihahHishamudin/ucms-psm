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
        Schema::create('conferences', function (Blueprint $table) {
            $table->id('Conference_id')->primary();
            $table->string('Conference_org');
            $table->string('Conference_website');
            $table->string('Conference_status');
            $table->string('Conference_name');
            $table->string('Conference_abbr');
            $table->string('Conference_desc', 700);
            $table->string('Conference_venue');
            $table->string('Conference_time');
            $table->string('Conference_date');
            $table->string('Conference_announcement', 400);
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
        Schema::dropIfExists('conferences');
    }
};
