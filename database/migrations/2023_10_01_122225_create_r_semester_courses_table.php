<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRSemesterCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_semester_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('r_semester_id')->constrained('registration_semesters');
            $table->foreignId('registration_id')->constrained('course_registrations');
            $table->foreignId('course_id')->constrained('courses');

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
        Schema::dropIfExists('r_semester_courses');
    }
}
