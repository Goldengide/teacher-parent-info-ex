<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_summaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_id')->default(0);
            $table->integer('subject_id')->default(0);
            $table->integer('season_id')->default(0);
            $table->integer('average_performance')->default(0);
            $table->integer('best_performance')->default(0);
            $table->integer('lowest_performance')->default(0);
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('class_summaries');
    }
}
