<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('result_id')->constrained('results');
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('semester_id')->constrained('semesters');
            $table->string('grade');
            $table->string('gpa');
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
        Schema::dropIfExists('result_courses');
    }
}
