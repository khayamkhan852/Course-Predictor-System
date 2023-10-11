<?php

namespace App\Services;

use App\Models\CourseRegistration;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DataService {
    public function getSemestersWithCoursesByDepartmentId($department_id): Collection
    {
        return Semester::with('courses:id,code,title,credit_hours')->where('department_id', $department_id)->get();
    }

    public function getSemestersOfStudentByStudentId($student_id): array
    {
        $courseRegistrations = CourseRegistration::with([
            'registrationSemesters' => function ($query) {
                $query->with('semester:id,name')->select(['id', 'semester_id', 'registration_id']);
            }
        ])->where('student_id', $student_id)->get();

        $semesters = [];

        foreach ($courseRegistrations as $courseRegistration) {
            foreach ($courseRegistration->registrationSemesters as $registrationSemester) {
                $semesters [] = [
                    'semester_id' => $registrationSemester->semester_id,
                    'semester_name' => $registrationSemester->semester->name
                ];
            }
        }

        return $semesters;
    }

    public function getRegisteredSemesterCourses($semester_id, $student_id = null): array
    {
        $courseRegistrations = CourseRegistration::with([
            'registrationSemesters' => function ($query) use ($semester_id) {
                $query->where('semester_id', $semester_id)->select(['registration_id', 'semester_id', 'id'])->with([
                    'registrationSemesterCourses' => function ($query) {
                        $query->with(['course:id,title,code,credit_hours'])->select(['id', 'registration_id', 'r_semester_id', 'course_id']);
                    }
                ]);
            }
        ])->when($student_id !== null, function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })->get();

        $courses = [];


        foreach ($courseRegistrations as $courseRegistration) {
            foreach ($courseRegistration->registrationSemesters as $registrationSemester) {
                foreach ($registrationSemester->registrationSemesterCourses as $registrationSemesterCourse) {
                    $courses [] = [
                        'course_id' => $registrationSemesterCourse->course_id,
                        'course_title' => $registrationSemesterCourse->course->title,
                        'course_code' => $registrationSemesterCourse->course->code,
                        'credit_hours' => $registrationSemesterCourse->course->credit_hours,
                    ];
                }
            }
        }

        return $courses;
    }
}
