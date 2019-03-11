<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->default(0);
            $table->integer('season_id')->default(0);
            $table->integer('class_id')->default(0);
            $table->integer('teacher_id')->default(0);
            $table->integer('subject_id')->default(0);
            $table->integer('assessment')->default(0);
            $table->integer('exam_score')->default(0);
            $table->integer('total')->default(0);
            $table->tinyInteger('approved')->default(0);
            $table->tinyInteger('processed')->default(0);
            $table->integer('times_uploaded')->default(0);
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
        Schema::dropIfExists('results');
    }
}
