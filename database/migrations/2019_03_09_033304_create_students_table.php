<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parent_name');
            $table->string('img_url')->default('profile.jpg');
            // $table->integer('parent_id')->default(0);
            $table->integer('class_id');
            $table->integer('entry_class_id')->default(0);
            $table->integer('entry_season_id')->default(0);
            $table->integer('exit_season_id')->default(0);
            $table->tinyInteger('graduated')->default(0);
            $table->tinyInteger('graduating')->default(0);
            $table->string('profile_pics')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('likes')->nullable();
            $table->string('dislikes')->nullable();
            $table->string('habits')->nullable();
            $table->string('student_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('students');
    }
}
