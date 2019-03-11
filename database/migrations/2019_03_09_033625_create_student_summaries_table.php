<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_summaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_id')->default(0);
            $table->integer('student_id')->default(0);
            $table->integer('season_id')->default(0);
            $table->integer('percentage')->default(0);
            $table->string('best_score')->nullable();
            $table->string('worse_score')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('student_summaries');
    }
}
