<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultiesTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties_times', function (Blueprint $table) {
            $table->id();

            $table->unsignedbigInteger('faculty_id')->nullable();
            $table->tinyInteger('work_date');
            $table->timestamps();

            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties_times');
    }
}
